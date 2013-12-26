<?php

/**
 * This is the model class for table "tbl_unit".
 *
 * The followings are the available columns in table 'tbl_unit':
 * @property integer $unit_id
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Pca[] $tblPcas
 * @property Target[] $tblTargets
 */
class Unit extends CActiveRecord
{
	public $unit_cannot_delete_dep = array('tbl_target_progress'=>'Indicator Beneficiaries Exist',
											 'tbl_pca_target_progress'=>'PCA Indicator Beneficiaries Exist'
											 );

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Unit the static model class
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
		return 'tbl_unit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type', 'required'),
			array('unit_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('unit_id, type', 'safe', 'on'=>'search'),
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
			'tblPcas' => array(self::MANY_MANY, 'Pca', 'tbl_non_hac_target(unit_id, pca_id)'),
			'tblTargets' => array(self::HAS_MANY, 'TargetProgress', 'unit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'unit_id' => 'Unit',
			'type' => 'Type',
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

		$criteria->compare('unit_id',$this->unit_id);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}