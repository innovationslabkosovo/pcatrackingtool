<?php

/**
 * This is the model class for table "tbl_non_hac_target".
 *
 * The followings are the available columns in table 'tbl_non_hac_target':
 * @property integer $pca_id
 * @property integer $unit_id
 * @property integer $total
 */
class NonHacTarget extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NonHacTarget the static model class
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
		return 'tbl_non_hac_target';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pca_id, unit_id', 'required'),
			array('pca_id, unit_id, total', 'numerical', 'integerOnly'=>true),
			array('received_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pca_id, unit_id, total', 'safe', 'on'=>'search'),
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
			'nonHacUnit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
			'pca' => array(self::BELONGS_TO, 'Pca', 'pca_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pca_id' => 'Pca',
			'unit_id' => 'Unit',
			'total' => 'Total',
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

		$criteria->compare('pca_id',$this->pca_id);
		$criteria->compare('unit_id',$this->unit_id);
		$criteria->compare('total',$this->total);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}