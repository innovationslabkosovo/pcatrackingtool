<?php
Yii::import('application.modules.user.models.YumUser');
/**
 * This is the model class for table "tbl_sector".
 *
 * The followings are the available columns in table 'tbl_sector':
 * @property integer $sector_id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Goal[] $goals
 */
class Sector extends CActiveRecord
{
	public $sector_cannot_delete_dep = array(
												'tbl_intermediate_result'=>'Intermediate Result Exists',
												'tbl_rrp5_output'=>'RRP Output Exists',
												'tbl_pca_sector'=>'PCA Exists',
												'tbl_activity'=>'Acitvity Exists',
												'tbl_goal'=>'CCC Exists',
												);
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sector the static model class
	 */

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	 public function defaultScope()
	{
		
		$condition = $this->returnSectorScopes("sector.sector_id IN ");
		return array(
	       'alias' => 'sector',
	       'condition' => $condition,
	    );  

	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_sector';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'unique'),
			array('name', 'length', 'max'=>45),
			//this alpha extension checks by default the field for letters only and allow spaces
			array('name', 'ext.alpha', 'allowSpaces'=>true),
			array('description', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sector_id, name, description', 'safe', 'on'=>'search'),
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
			'goals' => array(self::HAS_MANY, 'Goal', 'sector_id'),
			'users' => array(self::MANY_MANY, 'YumUser', 'tbl_sector_user(user_id, sector_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sector_id' => 'Sector',
			'name' => 'Name',
			'description' => 'Description',
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

		$criteria->compare('sector_id',$this->sector_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}