<?php

/**
 * This is the model class for table "tbl_locality".
 *
 * The followings are the available columns in table 'tbl_locality':
 * @property integer $locality_id
 * @property integer $region_id
 * @property integer $cad_code
 * @property integer $cas_code
 * @property integer $cas_code_un
 * @property string $name
 * @property string $cas_village_name
 */
class Locality extends CActiveRecord
{
	public $governorate;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Locality the static model class
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
		return 'tbl_locality';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('region_id, name', 'required'),
			array('region_id', 'numerical', 'integerOnly'=>true),
			array('name, cas_village_name', 'length', 'max'=>128),
			array('cad_code, cas_code, cas_code_un ', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('locality_id, governorate, region, cad_code, cas_code, cas_code_un, name, cas_village_name', 'safe', 'on'=>'search'),
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
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'locality_id' => 'Locality',
			'region_id' => 'Kadaa',
			'cad_code' => 'CAD Code',
			'cas_code' => 'CAS Code',
			'cas_code_un' => 'CAS Code UN',
			'name' => 'Locality',
			'cas_village_name' => 'CAS Village Name',
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

		$criteria->compare('locality_id',$this->locality_id);
		//$criteria->compare('region_id',$this->region_id);
		$criteria->compare('cad_code',$this->cad_code);
		$criteria->compare('cas_code',$this->cas_code);
		$criteria->compare('cas_code_un',$this->cas_code_un);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('cas_village_name',$this->cas_village_name,true);
		$criteria->compare('governorate.name',$this->governorate, true);
		$criteria->compare('region.name',$this->region, true);
		$criteria->with = array('region.governorate');


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}