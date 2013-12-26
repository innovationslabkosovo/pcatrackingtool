<?php

/**
 * This is the model class for table "tbl_pca_wbs".
 *
 * The followings are the available columns in table 'tbl_pca_wbs':
 * @property integer $pca_id
 * @property integer $wbs_id
 */
class PcaWbs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PcaWbs the static model class
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
		return 'tbl_pca_wbs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pca_id, wbs_id', 'required'),
			array('pca_id, wbs_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pca_id, wbs_id', 'safe', 'on'=>'search'),
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
			'Pca' => array(self::BELONGS_TO, 'Pca', 'pca_id'),
			'Wbs' => array(self::BELONGS_TO, 'Wbs', 'wbs_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pca_id' => 'Pca',
			'wbs_id' => 'Wbs',
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
		$criteria->compare('wbs_id',$this->wbs_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}