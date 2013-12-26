<?php

/**
 * This is the model class for table "tbl_rrp5_output".
 *
 * The followings are the available columns in table 'tbl_rrp5_output':
 * @property integer $rrp5_output_id
 * @property integer $sector_id
 * @property string $name
 */
class Rrp5Output extends CActiveRecord
{
	
	public $rrp_cannot_delete_dep = array('tbl_pca_rrp5output'=>'PCA Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rrp5Output the static model class
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
		return 'tbl_rrp5_output';
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
			array('rrp5_output_id, sector_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rrp5_output_id, sector, name', 'safe', 'on'=>'search'),
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
			'sector' => array(self::BELONGS_TO, 'Sector', 'sector_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rrp5_output_id' => 'RRP Output',
			'sector_id' => 'Sector',
			'name' => 'RRP Output Name',
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

		$criteria->compare('rrp5_output_id',$this->rrp5_output_id);
		$criteria->compare('sector.name',$this->sector,true);
		$criteria->compare('t.name',$this->name,true); //t.name refers to RRP4 output name attribute
		$criteria->with = array('sector');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}