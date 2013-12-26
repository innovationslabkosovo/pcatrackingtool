<?php
Yii::import('application.modules.user.models.YumUser');

class PcaUserActionController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        $user_criteria = 'username';
        return array(
//            array('allow',  // allow all users to perform 'index' and 'view' actions
//                'actions'=>array('index','view'),
//                'users'=>array('*'),
//            ),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions'=>array('create','update'),
//                'users'=>array('@'),
//            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','index'),
                'users'=>$this->getSuperUsers(),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('PcaUserAction');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new PcaUserAction('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['PcaUserAction']))
            $model->attributes=$_GET['PcaUserAction'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PcaUserAction the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=PcaUserAction::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PcaUserAction $model the model to be validated
     */
   
}
