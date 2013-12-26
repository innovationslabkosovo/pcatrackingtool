<?php

/**
 * This is the model class for table "tbl_pca_target_progress".
 *
 * The followings are the available columns in table 'tbl_pca_target_progress':
 * @property integer $grant_id
 * @property integer $funds
 * @property integer $pca_id
 * @property integer $total
 * @property integer $current
 * @property integer $shortfall
 *
 * The followings are the available model relations:
 * @property TargetProgress $tpTarget
 * @property TargetProgress $tpUnit
 * @property Pca $pca
 */
class PcaGrant extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PcaTargetProgress the static model class
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
		return 'tbl_pca_grant';
	}

	// public function defaultScope()
	// {	
	
	// 	$condition = ("active=1");
	// 	return array(
 //            'alias' => $this->tableName(),
 //            'condition' => $condition,
 //            'order' => 'grant_id ASC',
 //        );  
	
	// }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grant_id, funds, pca_id', 'required'),
			array('grant_id, funds, pca_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('grant_id, pca_id, funds', 'safe', 'on'=>'search'),
		);
	}

	public function primaryKey()
	{
		return array('grant_id','pca_id');
		# code...
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'grant' => array(self::BELONGS_TO, 'Grant', 'grant_id'),
			'pca' => array(self::BELONGS_TO, 'Pca', 'pca_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'grant_id' => 'Grant',
			'funds' => 'Funds',
			'pca_id' => 'Pca',
			
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
		$criteria->compare('funds',$this->funds);
		$criteria->compare('pca_id',$this->pca_id);
	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}