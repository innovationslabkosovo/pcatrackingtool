<?php

/**
 * This is the model class for table "tbl_region".
 *
 * The followings are the available columns in table 'tbl_region':
 * @property integer $region_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Location[] $locations
 */
class Region extends CActiveRecord
{
	public $region_cannot_delete_dep = array('tbl_locality'=>'Locality Exists');
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Region the static model class
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
		return 'tbl_region';
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
			array('region_id', 'numerical', 'integerOnly'=>true),
			array('name', 'unique'),
			array('name', 'ext.alpha', 'allowSpaces'=>true), //this extension checks by default the field for letters only and allow spaces
			array('name', 'length', 'max'=>45),
			array('governorate_id','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('region_id, name, governorate', 'safe', 'on'=>'search'),
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
			'governorate' => array(self::BELONGS_TO, 'Governorate', 'governorate_id'),
			'LocationRel' => array(self::HAS_MANY, 'Location', 'region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'region_id' => 'Kadaa',
			'name' => 'Kadaa',
			'governorate_id' => 'Governorate',
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

		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('governorate.name',$this->governorate,true);
		$criteria->with = array('governorate');
		$criteria->together = true;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}