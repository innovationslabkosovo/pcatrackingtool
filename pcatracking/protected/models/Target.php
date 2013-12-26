<?php

/**
 * This is the model class for table "tbl_target".
 *
 * The followings are the available columns in table 'tbl_target':
 * @property integer $target_id
 * @property integer $goal_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Donor[] $tblDonors
 * @property Goal $goal
 * @property Activity[] $tblActivities
 * @property Unit[] $targetProgress
 */
class Target extends CActiveRecord
{

	public $assignedUnits;
	public $assignedPcas;
	//public $assignedDonors;
	public $assignedTotals;
	public $assignedActivities;
	public $assignedShortfalls;
	public $assignedProgrammed;
	public $sector;

	public $currentBen;
    public $units;
	public $target_excel_has_many_realations = array("TargetProgressRel"=>array(
																		0=>array('total','current','shortfall','type'),
																		1=>array(null,null,null,'array("tpUnit")')
																		),
													 );

	public $target_cannot_delete_dep = array('tbl_target_progress'=>'Indicator Beneficiaries Exist',
											 'tbl_pca_target_progress'=>'PCA Indicator Beneficiaries Exist',
											 'tbl_target_progress_pca_report'=> 'PCA Report Indicator Beneficiaries Exist',
											 );

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Target the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function defaultScope()
	{	
	
		$condition = $this->returnSectorScopes("target.goal_id IN (select distinct goal_id from tbl_goal where sector_id IN ");
		return array(
			'alias' => 'target',
            'condition' => $condition,
        );  
	
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_target';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goal_id, name', 'required'),
			array('goal_id', 'numerical', 'integerOnly'=>true),
			//array('name', 'length', 'max'=>128),
			array('TargetProgressRel','checkcurrentTarget'),
            array('units','unitsToDelete'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('target_id, sector, goal, name, assignedProgrammed, assignedShortfalls, assignedTotals, assignedUnits', 'safe', 'on'=>'search'),
		);
	}

	// validation for target beneficiaries
	public function checkcurrentTarget($attribute,$params)
	{
		// check for null
		// if ($this->TargetProgressRel[0] == NULL)
		if ( !isset($this->TargetProgressRel[0]) )
		{
			//$this->addError($attribute,'No beneficiaries added !');	
		}else
		{
			foreach ($this->TargetProgressRel as $key => $value) {
				$counter = $key + 1;

				if ($value['total'] < $value['current']) // if total target smaller than current target
					$this->addError($attribute,'Total target '.$counter.' cannot be lower than programmed target');	
				if ($value['total'] != NULL && $value['unit_id'] == NULL) // total entered but unit is empty
					$this->addError($attribute,'Select unit in target '.$counter);
				# code...
			}
		}
				
	}


    public function unitsToDelete($attribute,$params)
    {
        if ($this->units != NULL)
        {
            $units_array = explode(",", $this->units);
            foreach ($units_array as $unit)
            {
                if ($unit_model = TargetProgress::model()->find("target_id=$this->target_id AND unit_id = $unit"))
                {
                   // print_r($unit_model);
                    if ($unit_model['current'] > 0)
                    {
                        $this->addError($attribute,'Unit "'.$unit_model->tpUnit['type'].'" cannot be deleted due to its programmed target');
                    }
                }
            }


        }


    }

// ESaveRelatedBehavior extension for has-many and many-to-many relations
	public function behaviors(){
          return array(  'ESaveRelatedBehavior'=>array(
            'class'=>'application.extensions.ESaveRelatedBehavior',));
          }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'DonorTargetRel' => array(self::HAS_MANY, 'DonorTarget', 'target_id'),
			'goal' => array(self::BELONGS_TO, 'Goal', 'goal_id'),
			'TargetActivity' => array(self::MANY_MANY, 'Activity', 'tbl_target_activity(target_id, activity_id)'),
			'TargetProgressRel' => array(self::HAS_MANY, 'TargetProgress', 'target_id'),

			//'rrp5output' => array(self::BELONGS_TO, 'Rrp5Output', 'rrp5_output_id'),
		);

			// 'DonorTargetRel' => array(self::HAS_MANY, 'DonorTarget', 'target_id'),
			// 'goal' => array(self::BELONGS_TO, 'Goal', 'goal_id'),
			// 'TargetActivity' => array(self::MANY_MANY, 'Activity', 'tbl_target_activity(target_id, activity_id)'),
			// 'TargetProgressRel' => array(self::HAS_MANY, 'TargetProgress', 'target_id'),
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'target_id' => 'Indicator',
			'sector' => 'Sector',
			'goal_id' => 'CCC',
			'goal' => 'CCC',
			'name' => 'Main Indicator',
			'assignedUnits' => 'Unit',
			'assignedPcas' => 'PCA-s implemented by target',
			'assignedTotals' => 'Total Beneficiaries',
			'assignedShortfalls' => 'Shortfall of Beneficiaries',
			'assignedProgrammed' => 'Programmed Beneficiaries',

			'assignedActivities' => 'Activities implemented by target',
			'rrp5_output_id' => 'RRP5 Output',
			'TargetProgressRel'=> 'Target',
			'total_RRP5_target' => 'Total RRP5 Target',

	
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('target_id',$this->target_id);
		$criteria->compare('sector.name',$this->sector, true);
		$criteria->compare('goal.name',$this->goal, true);
		$criteria->compare('target.name',$this->name, true);
		$criteria->compare('tpUnit.type',$this->assignedUnits, true);
		$criteria->compare('tbl_target_progress.current',$this->assignedProgrammed);
		$criteria->compare('tbl_target_progress.total',$this->assignedTotals);
		$criteria->compare('tbl_target_progress.shortfall',$this->assignedShortfalls);
		$criteria->with = array('goal.sector','TargetProgressRel.tpUnit');

		$criteria->group = 'target.target_id';
		$criteria->together = true;


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}