<?php


class PcaFile extends CActiveRecord
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
        return 'tbl_pca_file';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('file_name, pca_id', 'required'),
            array('file_category', 'safe'),

        );
    }

    public function primaryKey()
    {
        return array('pca_file_id');
        # code...
    }

    public function defaultScope()
    {

        return array(
            'alias' => $this->tableName(),
            'order' => $this->tableName().'.file_category ASC',
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
            'Pca' => array(self::BELONGS_TO, 'Pca', 'pca_id'),


        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(

        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */

}