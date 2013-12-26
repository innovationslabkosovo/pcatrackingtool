<?php

class DonorController extends Controller
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
		$model=new Donor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (Yii::app()->request->isAjaxRequest) 
		{	
			//$removeWidget = FALSE;
			$dialog_flag = TRUE;
			( isset($_GET['number']) ) ? $donor_number = $_GET['number'] : $donor_number = '';

		}


		if(isset($_POST['Donor']))
		{
			$model->attributes=$_POST['Donor'];
			if($model->save())
			{
				if($_POST['dialog_flag']){	

					 echo CHtml::tag('option',array (
                                'value'=>$model->donor_id,
                                'selected'=>true
                            ),CHtml::encode($model->name),true);

				}else $this->redirect(array('view','id'=>$model->donor_id));
			}
		}
		else
		{
			// if($dialog_flag)
			if( isset($dialog_flag) )
			{
				
			    $this->render('_form',array('model'=>$model,'dialog_flag'=>$dialog_flag, 'donor_number'=> $donor_number),false,true);
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

		if(isset($_POST['Donor']))
		{
			$model->attributes=$_POST['Donor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->donor_id));
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
			
			foreach ($loaded->donor_cannot_delete_dep as $key => $value) {
				if (strpos($e->getMessage(), $key))
					$error_message = $value;
			}

			if(!isset($_GET['ajax']))
			{
				$this->redirect(array($id, 'errorMessage'=>$error_message));// $e->getMessage();
			}else
			{
				header('HTTP/1.1 500', 'internal error');
        		echo 'Donor "'.$loaded->name.'" cannot be deleted due to the following dependecies: '.$error_message;//html for 500 page

			} 
		}
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Donor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Donor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Donor']))
			$model->attributes=$_GET['Donor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Donor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Donor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Donor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='donor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
