<?php

/**
 * This is the model class for table "tbl_pca_".
 *
 * The followings are the available columns in table 'tbl_pca_Rrp5Output':
 * @property integer $pca_id
 * @property integer $rrp5_output_id
 */
class PcaRrp5Output extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PcaRrp5Output the static model class
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
        return 'tbl_pca_rrp5output';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pca_id, rrp5_output_id', 'required'),
            array('pca_id, rrp5_output_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('pca_id, rrp5_output_id', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'pca_id' => 'Pca',
            'rrp5_output_id' => 'Rrp Output',
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

        $criteria->compare('pca_id',$this->pca_id);
        $criteria->compare('rrp5_output_id',$this->rrp5_output_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}