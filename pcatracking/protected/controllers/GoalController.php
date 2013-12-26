<?php

class GoalController extends Controller
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
				'actions'=>array('create'),
				'users'=>$this->getAccessLevels('goal_create'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>$this->getAccessLevels('goal_update'),
			),
			array('allow', // allow admin user to perform 'admin' actions
				'actions'=>array('admin'),
				'users'=>$this->getAccessLevels('goal_admin'),
			),
			array('allow', // allow admin user to perform 'delete' actions
				'actions'=>array('delete'),
				'users'=>$this->getAccessLevels('goal_delete'),
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
		$model=new Goal;
		$relatedTables = array();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Goal']))
		{

			$model->attributes=$_POST['Goal'];
			// if($_POST['Goal']['donorGoal'] != NULL)				
			// {
				
			// 	$this->transpose($_POST['Goal']['donorGoal'], $output);
			// 	//print_r($output);
			// 	$model->donorGoal = $output;
			// }
		//	print_r($model->donorGoal);
/*			if($_POST['Target']['targetProgress'] != NULL )
			{
				$_POST['Target']['targetProgress']['shortfall'] = $_POST['Target']['targetProgress']['total'];
				$this->transpose($_POST['Target']['targetProgress'], $out);			
				$model->targetProgress  = $out;
				$relatedTables[] = 'targetProgress';
			}*/
			if($model->saveWithRelated(array()))		
				$this->redirect(array('view','id'=>$model->goal_id));



			/*$model->attributes=$_POST['Goal'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->goal_id));*/
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Goal']))
		{
			$model->attributes=$_POST['Goal'];
			// if(isset($_POST['Goal']['donorGoal'])){
			// 	$this->transpose($_POST['Goal']['donorGoal'], $output);
			// 	$model->donorGoal = $output;
			// }
			if($model->saveWithRelated(array()))
				$this->redirect(array('view','id'=>$model->goal_id));
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
			
			foreach ($loaded->goal_cannot_delete_dep as $key => $value) {
				if (strpos($e->getMessage(), $key))
					$error_message = $value;
			}

			if(!isset($_GET['ajax']))
			{
				$this->redirect(array($id, 'errorMessage'=>$error_message));// $e->getMessage();
			}else
			{
				header('HTTP/1.1 500', 'internal error');
        		echo 'CCC "'.$loaded->name.'" cannot be deleted due to the following dependecies: '.$error_message;//html for 500 page

			} 
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Goal');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Goal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Goal']))
			$model->attributes=$_GET['Goal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Goal the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Goal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		//This part loads all related donors per goal
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Goal $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='goal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
