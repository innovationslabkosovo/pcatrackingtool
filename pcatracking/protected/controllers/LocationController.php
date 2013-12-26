<?php

class LocationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    public $superusers;

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
        $superusers = $this->getSuperUsers();
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>$superusers,
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>$superusers,
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>$superusers,
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Location;
		$removeWidget = 1;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (Yii::app()->request->isAjaxRequest) 
		{	
			//$removeWidget = FALSE;
			$dialog_flag = TRUE;
			$location_number = $_GET['number'];

		}
		
		if(isset($_POST['Location']))
		{
			$model->attributes=$_POST['Location'];
			echo $_POST['dialog_flag'];
			if($model->save())
			{
				if($_POST['dialog_flag']){	
					echo $model->location_id;
					 echo CHtml::tag('option',array (
                                'value'=>$model->location_id,
                                'selected'=>true
                            ),CHtml::encode($model->name),true);

				}else $this->redirect(array('view','id'=>$model->location_id));
			}
			else{
				echo 'not saved';
			}
		}else
		{
			if( isset($dialog_flag) )
			{
				
			    $this->render('_form',array('model'=>$model,'dialog_flag'=>$dialog_flag, 'location_number'=> $location_number),false,true);
	        }
	        else
	        {
	        	 $this->render('create',array('model'=>$model));
	        }
    	}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Location']))
		{
			$model->attributes=$_POST['Location'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->location_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Location');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Location('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Location']))
			$model->attributes=$_GET['Location'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Location the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Location::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Location $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='location-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
