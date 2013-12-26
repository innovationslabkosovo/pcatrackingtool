<?php

/**
 * This is the model class for table "tbl_wbs".
 *
 * The followings are the available columns in table 'tbl_wbs':
 * @property integer $wbs_id
 * @property integer $ir_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Pca[] $tblPcas
 */
class Wbs extends CActiveRecord
{
	public $wbs_sector;
	public $wbs_cannot_delete_dep = array('tbl_pca_wbs'=>'PCA Exists');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Wbs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function defaultScope()
	{	
		
		return array(
            'alias' => $this->tableName(),
            'order' => $this->tableName().'.ir_id ASC',
        );  

	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_wbs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ir_id, name', 'required'),
			array('wbs_id, ir_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('wbs_id, IntermediateResult, name, wbs_sector', 'safe', 'on'=>'search'),
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
			'Pca' => array(self::MANY_MANY, 'Pca', 'tbl_pca_wbs(wbs_id, pca_id)'),
			'IntermediateResult' => array(self::BELONGS_TO, 'IntermediateResult', 'ir_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'wbs_id' => 'Wbs',
			'ir_id' => 'Intermediate Result',
			'wbs_sector' => 'Sector',
			'name' => 'WBS/Activity',
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
		//wbs_sector
		$criteria->compare('wbs_id',$this->wbs_id);
		$criteria->compare('IntermediateResult.name',$this->ir_id, true);
		$criteria->compare('sector.name',$this->wbs_sector, true);
		$criteria->compare('tbl_wbs.name',$this->name,true);

		$criteria->with = array('IntermediateResult.sector');
		$criteria->together = true;


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}