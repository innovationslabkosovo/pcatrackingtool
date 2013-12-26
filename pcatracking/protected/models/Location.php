<?php

/**
 * This is the model class for table "tbl_location".
 *
 * The followings are the available columns in table 'tbl_location':
 * @property integer $location_id
 * @property integer $region_id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 *
 * The followings are the available model relations:
 * @property Region $region
 * @property PartnerOrganization[] $tblPartnerOrganizations
 * @property Pca[] $tblPcas
 */
class Location extends CActiveRecord
{
	public $governorate;
	public $region;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Location the static model class
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
		return 'tbl_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('locality_id, name', 'required'),
			array('location_id, locality_id', 'numerical', 'integerOnly'=>true),
			array('name', 'unique'),
			array('name', 'length', 'max'=>45),
			array('p_code', 'safe'),
			//this alpha extension checks by default the field for letters only and allow spaces and numbers as well
			array('name', 'ext.alpha', 'allowSpaces'=>true, 'allowNumbers'=>true),
			array('latitude, longitude', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('location_id, locality, region, governorate, name, latitude, longitude', 'safe', 'on'=>'search'),
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
			'locality' => array(self::BELONGS_TO, 'Locality', 'locality_id'),
			'PartnerLocation' => array(self::MANY_MANY, 'PartnerOrganization', 'tbl_partner_location(location_id, partner_id)'),
			'PcaLocation' => array(self::MANY_MANY, 'Pca', 'tbl_pca_location(pca_id,location_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'location_id' => 'Villages',
			'region' => 'Kadaa',
			'locality' => 'Locality',
			'name' => 'Villages',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
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

		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('governorate.name',$this->governorate, true);
		$criteria->compare('region.name',$this->region, true);
		$criteria->compare('locality.name',$this->locality, true);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->with = array('locality.region.governorate');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}