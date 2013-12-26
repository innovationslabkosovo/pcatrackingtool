<?php

/**
 * This is the model class for table "tbl_goal".
 *
 * The followings are the available columns in table 'tbl_goal':
 * @property integer $goal_id
 * @property integer $sector_id
 * @property string $name
 * @property string $code
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Donor[] $tblDonors
 * @property Sector $sector
 * @property Pca[] $tblPcas
 * @property Target[] $targets
 */
class Goal extends CActiveRecord
{

	public $goal_cannot_delete_dep = array('tbl_target'=>'Indicator Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Goal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_goal';
	}

	public function defaultScope()
	{
		
		$condition = $this->returnSectorScopes("goal.sector_id IN ");
		return array(
			'alias' => 'goal',
            'condition' => $condition,
        );  

	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sector_id, name', 'required'),
			array('sector_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>512),
			array('description', 'length', 'max'=>512),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('goal_id, sector, name, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'donorGoal' => array(self::HAS_MANY, 'DonorGoal', 'goal_id'),
			'sector' => array(self::BELONGS_TO, 'Sector', 'sector_id'),			
			'targets' => array(self::HAS_MANY, 'Target', 'goal_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'goal_id' => 'CCC',
			'sector_id' => 'Sector',
			'name' => 'CCC Name',
			'description' => 'Description',
		);
	}

// CAdvancedArBehaviour extension for many-to-many relations
	public function behaviors(){
          return array(  'ESaveRelatedBehavior'=>array(
            'class'=>'application.extensions.ESaveRelatedBehavior',));
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

		$criteria->compare('goal_id',$this->goal_id);
		$criteria->compare('sector.name',$this->sector,true);
		$criteria->compare('goal.name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->with = array('sector');
		$criteria->together = true;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}