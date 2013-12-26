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
class TargetChange extends CActiveRecord
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
        return 'tbl_target_change';
    }
//
//	public function defaultScope()
//	{
//
//		$condition = ($this->tableName().".active=1");
//		return array(
//            'alias' => $this->tableName(),
//            'condition' => $condition,
//        );
//
//	}

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('target_progress_id, total', 'required'),
            array('total', 'numerical' ,'integerOnly'=>true),
            array('start_date','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(' total', 'safe', 'on'=>'search'),
        );
    }

    public function primaryKey()
    {
        return array('pca_report_tp_id');
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
            'TargetProgressRel' => array(self::BELONGS_TO, 'TargetProgress', 'tbl_pca_target_progress(target_progress_id)'),


        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */

    /**
     * Retrieves a list of models based on the active search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */

}