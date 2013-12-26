<?php

/**
 * This is the model class for table "tbl_grant".
 *
 * The followings are the available columns in table 'tbl_grant':
 * @property integer $grant_id
 * @property integer $donor_id
 * @property string $name
 */
class Grant extends CActiveRecord
{
	public $grant_cannot_delete_dep = array('tbl_pca_grant'=>'PCA Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Grant the static model class
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
		return 'tbl_grant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('donor_id, name', 'required'),
			array('grant_id, donor_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('donor_id','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('grant_id, donor.name, name', 'safe', 'on'=>'search'),
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
			'donor' => array(self::BELONGS_TO, 'Donor', 'donor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'grant_id' => 'Grant',
			'donor_id' => 'Donor',
			'name' => 'Grant Reference Number',
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

		$criteria->compare('grant_id',$this->grant_id);
		//$criteria->compare('donor_id',$this->donor_id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('donor.name',$this->donor_id,true);

		$criteria->with = array('donor');
		$criteria->together = true; 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}