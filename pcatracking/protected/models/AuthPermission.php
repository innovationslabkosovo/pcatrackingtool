<?php

/**
 * This is the model class for table "tbl_auth_permission".
 *
 * The followings are the available columns in table 'tbl_auth_permission':
 * @property integer $permission_id
 * @property integer $content_id
 * @property string $type
 * @property string $name
 *
 * The followings are the available model relations:
 * @property AuthGroup[] $tblAuthGroups
 * @property ContentType $content
 * @property AuthUser[] $tblAuthUsers
 */
class AuthPermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuthPermission the static model class
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
		return 'tbl_auth_permission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('permission_id, content_id, type', 'required'),
			array('permission_id, content_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>10),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('permission_id, content_id, type, name', 'safe', 'on'=>'search'),
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
			'tblAuthGroups' => array(self::MANY_MANY, 'AuthGroup', 'tbl_auth_group_permission(permission_id, group_id)'),
			'content' => array(self::BELONGS_TO, 'ContentType', 'content_id'),
			'tblAuthUsers' => array(self::MANY_MANY, 'AuthUser', 'tbl_auth_user_permission(permission_id, user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'permission_id' => 'Permission',
			'content_id' => 'Content',
			'type' => 'Type',
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

		$criteria->compare('permission_id',$this->permission_id);
		$criteria->compare('content_id',$this->content_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}