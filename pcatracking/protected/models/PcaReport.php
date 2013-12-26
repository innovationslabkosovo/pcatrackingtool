<?php

/**
 * This is the model class for table "tbl_pca_report".
 *
 * The followings are the available columns in table 'tbl_pca_report':
 * @property integer $pca_report_id
 * @property integer $pca_id
 * @property string $start_period
 * @property string $end_period
 * @property string $received_date
 *
 * The followings are the available model relations:
 * @property Pca $pca
 * @property TargetProgressPcaReport[] $targetProgressPcaReports
 */
class PcaReport extends CActiveRecord
{
	public $assignedTargets;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PcaReport the static model class
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
		return 'tbl_pca_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pca_id, start_period, end_period', 'required'),
			array('pca_id', 'numerical', 'integerOnly'=>true),
			array('title, description, received_date', 'safe'),
			array('assignedTargets','checkPcaReportTargetProgress'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pca_report_id, pca_id, start_period, end_period, received_date, title', 'safe', 'on'=>'search'),
		);
	}

	public function checkPcaReportTargetProgress($attribute,$params)
	{
		$i=0;
		//print_r($this->TargetProgressPcaReportRel);
		foreach ((array)$this->TargetProgressPcaReportRel as $key => $value) {
			if ($value['total'] == NULL)
			{	
				//echo $key;
				//unset($this->TargetProgressPcaReportRel[$key]);
				$i++;
			}
				$targetNo = $key+1;
            $pca_target_progress_id = $value['pca_target_progress_id'];
                $total = $value['total'];
				$existingTargetProgress = PcaTargetProgress::model()->findByPk($pca_target_progress_id);// find existing target
				if ($total > $existingTargetProgress->shortfall){
					$this->addError($attribute,'Pca Target '.$targetNo.' cannot be larger than overall Pca Target Progress');	
				}
			
		}

		//if ($i == sizeof($this->TargetProgressPcaReportRel))
			//$this->addError($attribute,'Indicator Beneficiaries cannot be blank.');
		
	}

	protected function beforeSave()
	{ 

		$this->start_period=date('Y-m-d', strtotime($this->start_period));
		$this->end_period=date('Y-m-d', strtotime($this->end_period));
		//$this->received_date=date('Y-m-d', strtotime($this->end_period));

		
		return parent::beforeSave();
	}


	protected function afterFind()
	{
		if (!empty($this->start_period)) $this->start_period=date('d-m-Y', strtotime($this->start_period));
		
		if (!empty($this->end_period)) $this->end_period=date('d-m-Y', strtotime($this->end_period));
		if (!empty($this->received_date)) $this->received_date=date('d-m-Y', strtotime($this->received_date));
	
		return TRUE;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pca' => array(self::BELONGS_TO, 'Pca', 'pca_id'),
			'TargetProgressPcaReportRel' => array(self::HAS_MANY, 'TargetProgressPcaReport', 'pca_report_id'),
            'PcaReportFile' => array(self::HAS_MANY, 'PcaReportFile', 'pca_report_id'),

        );
	}

	public function behaviors(){
        return array(  'ESaveRelatedBehavior'=>array(
            'class'=>'application.extensions.ESaveRelatedBehavior',));
          }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pca_report_id' => 'PCA Report',
			'pca_id' => 'PCA Title',
			'title' => 'PCA Report Title',
			'start_period' => 'Start Period',
			'end_period' => 'End Period',
			'received_date' => 'Received Date',
			'assignedTargets' => 'TB',
			'pca' => 'PCA'
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

		$criteria->compare('pca_report_id',$this->pca_report_id);
		$criteria->compare('pca_id',$this->pca_id);
		$criteria->compare('start_period',$this->start_period,true);
		$criteria->compare('end_period',$this->end_period,true);
		$criteria->compare('received_date',$this->received_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}