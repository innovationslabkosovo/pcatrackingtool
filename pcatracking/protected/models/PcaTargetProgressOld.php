<?php

/**
 * This is the model class for table "tbl_pca_target_progress".
 *
 * The followings are the available columns in table 'tbl_pca_target_progress':
 * @property integer $target_id
 * @property integer $unit_id
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
class PcaTargetProgressOld extends CActiveRecord
{
    public $sum;
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
        return 'tbl_pca_target_progress';
    }

    public function defaultScope()
    {

        $condition = ($this->tableName().".active=1");
        return array(
            'alias' => $this->tableName(),
            'condition' => $condition,
            'order' => $this->tableName().'.target_id ASC',
        );

    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('target_id, unit_id, pca_id', 'required'),
            array('target_id, unit_id, pca_id, total, current, shortfall', 'numerical', 'integerOnly'=>true),
            array('received_date, active', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('target_id, unit_id, pca_id, total, current, shortfall', 'safe', 'on'=>'search'),
        );
    }

    public function primaryKey()
    {
        return array('target_id','unit_id','pca_id');
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
            'tpTarget' => array(self::BELONGS_TO, 'TargetProgress', array('target_id','unit_id')),
            'tpUnit' => array(self::BELONGS_TO, 'TargetProgress', 'unit_id'),
            'pca' => array(self::BELONGS_TO, 'Pca', 'pca_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'target_id' => 'Tp Target',
            'unit_id' => 'Tp Unit',
            'pca_id' => 'Pca',
            'total' => 'Total',
            'current' => 'Current',
            'shortfall' => 'Shortfall',
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

        $criteria->compare('target_id',$this->target_id);
        $criteria->compare('unit_id',$this->unit_id);
        $criteria->compare('pca_id',$this->pca_id);
        $criteria->compare('total',$this->total);
        $criteria->compare('current',$this->current);
        $criteria->compare('shortfall',$this->shortfall);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}