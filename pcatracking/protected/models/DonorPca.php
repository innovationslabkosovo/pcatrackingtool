<?php

/**
 * This is the model class for table "tbl_donor_pca".
 *
 * The followings are the available columns in table 'tbl_donor_pca':
 * @property integer $donor_id
 * @property integer $pca_id
 * @property double $funds
 */
class DonorPca extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DonorPca the static model class
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
		return 'tbl_donor_pca';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('donor_id, pca_id', 'required'),
			array('donor_id, pca_id', 'numerical', 'integerOnly'=>true),
			array('funds', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('donor_id, pca_id, funds', 'safe', 'on'=>'search'),
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
			'donor_id' => 'Donor',
			'pca_id' => 'Pca',
			'funds' => 'Funds',
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

		$criteria->compare('donor_id',$this->donor_id);
		$criteria->compare('pca_id',$this->pca_id);
		$criteria->compare('funds',$this->funds);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}