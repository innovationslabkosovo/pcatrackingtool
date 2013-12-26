<?php

/**
 * This is the model class for table "tbl_target_progress".
 *
 * The followings are the available columns in table 'tbl_target_progress':
 * @property integer $target_id
 * @property integer $unit_id
 * @property integer $total
 * @property integer $current
 * @property integer $shortfall
 *
 * The followings are the available model relations:
 * @property PcaTargetProgress[] $pcaTargetProgresses
 * @property PcaTargetProgress[] $pcaTargetProgresses1
 * @property TargetProgressPcaReport[] $targetProgressPcaReports
 * @property TargetProgressPcaReport[] $targetProgressPcaReports1
 */
class TargetProgressCopy extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TargetProgress the static model class
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
        return 'tbl_target_progress';
    }

    public function defaultScope()
    {

        $condition = ($this->tableName().".active=1");
        return array(
            'alias' => $this->tableName(),
            'condition' => $condition,
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
            array('target_id, unit_id', 'required'),
            array('target_id, unit_id, total, current, shortfall', 'numerical' ,'integerOnly'=>true),
            array('received_date,active','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('target_id, unit_id, total, current, shortfall', 'safe', 'on'=>'search'),
        );
    }

    public function primaryKey()
    {
        return array('target_id','unit_id','current');
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
            'pcaTargetProgressRel' => array(self::HAS_MANY, 'PcaTargetProgress', 'tbl_pca_target_progress(target_id, unit_id,pca_id)'),
            //'pcaTargetProgresses1' => array(self::HAS_MANY, 'PcaTargetProgress', 'tp_unit_id'),
            'targetProgressPcaReports' => array(self::HAS_MANY, 'TargetProgressPcaReport', 'target_id'),
            //'targetProgressPcaReports1' => array(self::HAS_MANY, 'TargetProgressPcaReport', 'unit_id'),
            'tpTarget' => array(self::BELONGS_TO, 'Target', 'target_id'),
            'tpUnit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'target_id' => 'Target',
            'unit_id' => 'Unit',
            'total' => 'Total',
            'current' => 'Current',
            'shortfall' => 'Shortfall',
            'received_date' => 'Date Received',
            'active' => 'Active'
        );
    }

    /**
     * Retrieves a list of models based on the active search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('target_id',$this->target_id);
        $criteria->compare('unit_id',$this->unit_id);
        $criteria->compare('total',$this->total);
        $criteria->compare('current',$this->current);
        $criteria->compare('shortfall',$this->shortfall);
        $criteria->compare('active',$this->active);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}