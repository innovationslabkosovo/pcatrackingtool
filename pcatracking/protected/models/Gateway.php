<?php

/**
 * This is the model class for table "tbl_gateway".
 *
 * The followings are the available columns in table 'tbl_gateway':
 * @property integer $gateway_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Location[] $tblLocations
 */
class Gateway extends CActiveRecord
{

	public $gateway_cannot_delete_dep = array('tbl_gw_pca_loc'=>'PCA Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gateway the static model class
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
		return 'tbl_gateway';
	}

	// CAdvancedArBehaviour extension for many-to-many relations
	public function behaviors(){
          return array(  'ESaveRelatedBehavior'=>array(
            'class'=>'application.extensions.ESaveRelatedBehavior',));
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
			array('name', 'ext.alpha', 'allowSpaces'=>true), //this extension checks by default the field for letters only and allow spaces
			array('name', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gateway_id, name', 'safe', 'on'=>'search'),
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
			'tblLocations' => array(self::MANY_MANY, 'Location', 'tbl_location_gateway(gateway_id, location_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gateway_id' => 'Gateway',
			'name' => 'Name',
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

		$criteria->compare('gateway_id',$this->gateway_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}