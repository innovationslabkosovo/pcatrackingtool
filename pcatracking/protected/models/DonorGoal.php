<?php

/**
 * This is the model class for table "tbl_donor_goal".
 *
 * The followings are the available columns in table 'tbl_donor_goal':
 * @property integer $donor_id
 * @property integer $goal_id
 * @property double $funds
 */
class DonorGoal extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DonorGoal the static model class
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
		return 'tbl_donor_goal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('donor_id, goal_id', 'required'),
			array('donor_id, goal_id', 'numerical', 'integerOnly'=>true),
			array('funds', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('donor_id, goal_id, funds', 'safe', 'on'=>'search'),
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
			'dgGoal' => array(self::BELONGS_TO, 'Goal', 'goal_id'),
			'dgDonor' => array(self::BELONGS_TO, 'Donor', 'donor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'donor_id' => 'Donor',
			'goal_id' => 'Goal',
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
		$criteria->compare('goal_id',$this->goal_id);
		$criteria->compare('funds',$this->funds);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}