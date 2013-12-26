<?php

/**
 * This is the model class for table "tbl_intermediate_result".
 *
 * The followings are the available columns in table 'tbl_intermediate_result':
 * @property integer $ir_id
 * @property integer $sector_id
 * @property string $ir_wbs_reference
 * @property string $name
 */
class IntermediateResult extends CActiveRecord
{
	public $ir_cannot_delete_dep = array('tbl_wbs'=>'WBS Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IntermediateResult the static model class
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
		return 'tbl_intermediate_result';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sector_id, ir_wbs_reference, name', 'required'),
			array('sector_id', 'numerical', 'integerOnly'=>true),
			array('ir_wbs_reference', 'length', 'max'=>50),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ir_id, sector.name, ir_wbs_reference, name', 'safe', 'on'=>'search'),
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
			'ir_id' => 'Ir',
			'sector_id' => 'Sector',
			'ir_wbs_reference' => 'IR WBS Reference',
			'name' => 'IR Name',
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

		$criteria->compare('ir_id',$this->ir_id);
		$criteria->compare('sector.name',$this->sector_id,true);
		$criteria->compare('ir_wbs_reference',$this->ir_wbs_reference,true);
		$criteria->compare('t.name',$this->name,true); // t.name refers to intermediateResult.name

		$criteria->with = array('sector');
		$criteria->together = true; 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}