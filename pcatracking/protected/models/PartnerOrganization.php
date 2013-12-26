<?php

/**
 * This is the model class for table "tbl_partner_organization".
 *
 * The followings are the available columns in table 'tbl_partner_organization':
 * @property integer $partner_id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Location[] $tblLocations
 * @property Activity[] $tblActivities
 * @property Pca[] $pcas
 */
class PartnerOrganization extends CActiveRecord
{
	public $POlocality;
	public $POregion;
	public $POgovernorate;
	public $POlocation;
	public $partner_cannot_delete_dep = array('tbl_pca'=>'PCA Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PartnerOrganization the static model class
	 */

	public $partner_excel_has_many_realations = array("pca"=>array(0=>array('number')),);

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_partner_organization';
	}

	// public function defaultScope()
	// {	
		
	// 	return array(
 //            'alias' => 'partner',
 //            'order' => 'partner.name ASC',
 //        );  

	// }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>45),
			//this alpha extension checks by default the field for letters only and allow spaces and numbers as well
			array('name', 'ext.alpha', 'allowSpaces'=>true, 'allowNumbers'=>true),
			array('description', 'length', 'max'=>256),
			array('email, contact_person, phone_number', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('partner_id, name, description, POlocation, POregion, POgovernorate', 'safe', 'on'=>'search'),
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
			'tblLocations' => array(self::MANY_MANY, 'Location', 'tbl_partner_location(partner_id, location_id)'),
			'tblActivities' => array(self::MANY_MANY, 'Activity', 'tbl_partner_organization_activity(partner_id, activity_id)'),
			'pca' => array(self::HAS_MANY, 'Pca', 'partner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'partner_id' => 'Partner',
			'name' => 'Name',
			'description' => 'Description',
			'tblLocations' => 'Village',
			'tblActivities' => 'Activities',
			'pca' => 'PCAs',
			'email' => 'Email Address',
			'contact_person' => 'Contact Person',
			'phone_number' => 'Phone Number'
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

		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('tblLocations.name',$this->POlocation,true);
		$criteria->compare('locality.name',$this->POlocality,true);
		$criteria->compare('region.name',$this->POregion,true);
		$criteria->compare('governorate.name',$this->POgovernorate,true);

		$criteria->with = array('tblLocations.locality.region.governorate');
		$criteria->group = 't.partner_id';
	    $criteria->together = true;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}