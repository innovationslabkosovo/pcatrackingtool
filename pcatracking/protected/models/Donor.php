<?php

/**
 * This is the model class for table "tbl_donor".
 *
 * The followings are the available columns in table 'tbl_donor':
 * @property integer $donor_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Goal[] $tblGoals
 * @property Pca[] $tblPcas
 * @property Target[] $tblTargets
 */
class Donor extends CActiveRecord
{


	public $donor_cannot_delete_dep = array('tbl_grant'=>'Grant Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Donor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	// public function defaultScope()
	// {	
		
	// 	return array(
 //            'alias' => 'donor',
 //            'order' => 'donor.name ASC',
 //        );  

	// }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_donor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>45),
			array('name', 'unique'),
			//this alpha extension checks by default the field for letters only and allow spaces and numbers as well
			array('name', 'ext.alpha', 'allowSpaces'=>true, 'allowNumbers'=>true, 'extra'=>array('-', '/', '.')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('donor_id, name', 'safe', 'on'=>'search'),
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
			'tblGoals' => array(self::MANY_MANY, 'Goal', 'tbl_donor_goal(donor_id, goal_id)'),
			'tblPcas' => array(self::MANY_MANY, 'Pca', 'tbl_donor_pca(donor_id, pca_id)'),
			'tblTargets' => array(self::MANY_MANY, 'Target', 'tbl_donor_target(donor_id, target_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'donor_id' => 'Donor',
			'name' => 'Name',
		);
	}

	// CAdvancedArBehaviour extension for many-to-many relations
	public function behaviors(){
          return array( 'CAdvancedArBehavior' => array(
            'class' => 'application.extensions.CAdvancedArBehavior'));
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
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}