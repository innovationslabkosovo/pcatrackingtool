<?php

/**
 * This is the model class for table "tbl_target_progress_pca_report".
 *
 * The followings are the available columns in table 'tbl_target_progress_pca_report':
 * @property integer $target_id
 * @property integer $unit_id
 * @property integer $pca_report_id
 * @property integer $total
 *
 * The followings are the available model relations:
 * @property TargetProgress $target
 * @property TargetProgress $unit
 * @property PcaReport $pcaReport
 */
class TargetProgressPcaReportOld extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TargetProgressPcaReport the static model class
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
        return 'tbl_target_progress_pca_report';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('target_id, unit_id, pca_report_id', 'required'),
            array('target_id, unit_id, pca_report_id, total', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('target_id, unit_id, pca_report_id, total', 'safe', 'on'=>'search'),
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
            'target' => array(self::BELONGS_TO, 'TargetProgress', 'target_id'),
            'unit' => array(self::BELONGS_TO, 'TargetProgress', 'unit_id'),
            'pcaReport' => array(self::BELONGS_TO, 'PcaReport', 'pca_report_id'),
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
            'pca_report_id' => 'Pca Report',
            'total' => 'Total',
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
        $criteria->compare('pca_report_id',$this->pca_report_id);
        $criteria->compare('total',$this->total);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}