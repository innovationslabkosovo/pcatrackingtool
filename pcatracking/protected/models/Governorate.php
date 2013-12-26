<?php

/**
 * This is the model class for table "tbl_governorate".
 *
 * The followings are the available columns in table 'tbl_governorate':
 * @property integer $governorate_id
 * @property integer $name
 */
class Governorate extends CActiveRecord
{
	public $governorate_cannot_delete_dep = array('tbl_region'=>'Kadaa Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Governorate the static model class
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
		return 'tbl_governorate';
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
			array('name', 'unique'),
			array('name', 'ext.alpha', 'allowSpaces'=>true), //this extension checks by default the field for letters only and allow spaces
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('governorate_id, name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'governorate_id' => 'Governorate',
			'name' => 'Name',
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

		$criteria->compare('governorate_id',$this->governorate_id);
		$criteria->compare('name',$this->name);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}