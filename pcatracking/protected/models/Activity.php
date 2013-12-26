<?php

/**
 * This is the model class for table "tbl_activity".
 *
 * The followings are the available columns in table 'tbl_activity':
 * @property integer $activity_id
 * @property string $name
 * @property string $type
 *
 * The followings are the available model relations:
 * @property PartnerOrganization[] $PcaTargetProgressRel
 * @property Pca[] $pcas
 * @property Target[] $tblTargets
 */
class Activity extends CActiveRecord
{
	public $assignedTargets;
	public $assignedPcas;
	public $activity_cannot_delete_dep = array('tbl_pca_activity'=>'PCA Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Activity the static model class
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
		return 'tbl_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('activity_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('name', 'unique'),
			array('sector_id', 'safe'),
			//this alpha extension checks by default the field for letters only and allow spaces
			//array('name', 'ext.alpha', 'allowSpaces'=>true),
			array('type', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('activity_id, sector,  name, type', 'safe', 'on'=>'search'),
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
			//'PartnerOrganization' => array(self::MANY_MANY, 'PartnerOrganization', 'tbl_partner_organization_activity(activity_id, partner_id)'),
			//'PcaActivity' => array(self::MANY_MANY, 'Pca', 'tbl_pca_activity(activity_id, pca_id)'),
			//'TargetActivity' => array(self::MANY_MANY, 'Target', 'tbl_target_activity(activity_id, target_id)'),
			'sector' => array(self::BELONGS_TO, 'Sector', 'sector_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'activity_id' => 'Activity',
			'name' => 'Activity',
			'type' => 'Type',
			'assignedTargets' => 'Targets' ,
			'assignedPcas' => 'Pcas' ,
			'sector_id' => 'Sector'
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

		$criteria->compare('activity_id',$this->activity_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('sector.name',$this->sector,true);
		$criteria->with = array('sector');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}