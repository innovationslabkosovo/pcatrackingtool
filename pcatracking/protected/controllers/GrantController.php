<?php

class GrantController extends Controller
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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new Grant;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (Yii::app()->request->isAjaxRequest) 
		{	
			//$removeWidget = FALSE;
			$dialog_flag = TRUE;
			$grant_number = $_GET['number'];
			echo $grant_number;
		}

		if(isset($_POST['Grant']))
		{
			$model->attributes=$_POST['Grant'];
			if($model->save())
			{
				if($_POST['dialog_flag']){	

					 echo CHtml::tag('option',array (
                                'value'=>$model->grant_id,
                                'selected'=>true
                            ),CHtml::encode($model->name),true);

				}else $this->redirect(array('view','id'=>$model->grant_id));
			}
		}
		else
		{
			// if($dialog_flag)
			if( isset($dialog_flag) )
			{
				
			    $this->render('_form',array('model'=>$model,'dialog_flag'=>$dialog_flag, 'grant_number'=> $grant_number),false,true);
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

		if(isset($_POST['Grant']))
		{
			$model->attributes=$_POST['Grant'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->grant_id));
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
		$loaded = $this->loadModel($id);
		

		try {

			$loaded->delete();
			if(!isset($_GET['ajax']))
		    	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		} catch (Exception $e) {
			$error_message = "";
			
			foreach ($loaded->grant_cannot_delete_dep as $key => $value) {
				if (strpos($e->getMessage(), $key))
					$error_message = $value;
			}

			if(!isset($_GET['ajax']))
			{
				$this->redirect(array($id, 'errorMessage'=>$error_message));// $e->getMessage();
			}else
			{
				header('HTTP/1.1 500', 'internal error');
        		echo 'Grant "'.$loaded->name.'" cannot be deleted due to the following dependecies: '.$error_message;//html for 500 page

			} 
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Grant');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Grant('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Grant']))
			$model->attributes=$_GET['Grant'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Grant the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Grant::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Grant $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='grant-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
