<?php

/**
 * This is the model class for table "tbl_auth_user".
 *
 * The followings are the available columns in table 'tbl_auth_user':
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $date_joined
 * @property string $last_login
 * @property integer $is_superuser
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property AuthGroup[] $tblAuthGroups
 * @property AuthPermission[] $tblAuthPermissions
 */
class AuthUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuthUser the static model class
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
		return 'tbl_auth_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('is_superuser, is_active', 'numerical', 'integerOnly'=>true),
			array('username, first_name, last_name, email', 'length', 'max'=>45),
			array('password', 'length', 'max'=>128),
			array('date_joined, last_login', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, username, password, first_name, last_name, email, date_joined, last_login, is_superuser, is_active', 'safe', 'on'=>'search'),
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
			'tblAuthGroups' => array(self::MANY_MANY, 'AuthGroup', 'tbl_auth_user_group(user_id, group_id)'),
			'tblAuthPermissions' => array(self::MANY_MANY, 'AuthPermission', 'tbl_auth_user_permission(user_id, permission_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'password' => 'Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'date_joined' => 'Date Joined',
			'last_login' => 'Last Login',
			'is_superuser' => 'Is Superuser',
			'is_active' => 'Is Active',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('date_joined',$this->date_joined,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('is_superuser',$this->is_superuser);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}