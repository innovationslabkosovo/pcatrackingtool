<?php

class TargetController extends Controller
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
				'actions'=>array('index','view', 'generateExcel'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>$this->getAccessLevels('target_create'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>$this->getAccessLevels('target_update'),
			),
			array('allow', // allow admin user to perform 'admin'  actions
				'actions'=>array('admin'),
				'users'=>$this->getAccessLevels('target_admin'),
			),
			array('allow', // allow admin user to perform 'delete' actions
				'actions'=>array('delete'),
				'users'=>$this->getAccessLevels('target_delete'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
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

	public function actionGenerateExcel($id=null)
	{
		//This is for exporting one Target only - the one being viewed currently
		if(isset($id)) {

			$model = Target::model()->findAll('target_id='.$id);
			$columns_to_display = $this->getColumnstoDisplay($model, $model[0]->target_excel_has_many_realations, array('goal_id','target_id'), array('TargetActivity'));
			$this->toExcel($model, $columns_to_display, get_class($model[0]));

		} 
		//This is to export the currently filtered Targets 
		elseif (isset($_POST['hidden_excel'])) {
			$target_ids = explode(",", $_POST['hidden_excel'][0]); 
			$criteria = new CDbCriteria;
			$criteria->addInCondition('target_id', $target_ids);
			$model = Target::model()->findAll($criteria);
			$columns_to_display = $this->getColumnstoDisplay($model, $model[0]->target_excel_has_many_realations, array('goal_id','target_id'), array('TargetActivity'));
			$this->toExcel($model, $columns_to_display, get_class($model[0]));	
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Target;
		$relatedTables = array();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Target']))
		{
			$model->attributes=$_POST['Target'];
			// if( $_POST['Target']['TargetActivity'] != NULL )			
			if( isset($_POST['Target']['TargetActivity']) )			
			{
				//print_r($_POST['Target']['TargetActivity'] );
				$model->TargetActivity = $_POST['Target']['TargetActivity'];
				$relatedTables[] = 'TargetActivity';
			}
			
			// if($_POST['Target']['TargetProgressRel'] != NULL )
			if( isset($_POST['Target']['TargetProgressRel']) )
			{
				//$_POST['Target']['TargetProgressRel']['shortfall'] = $_POST['Target']['TargetProgressRel']['total'];
				
				$model->TargetProgressRel  = $this->manageRelations($_POST['Target']['TargetProgressRel'], 1);	
				$relatedTables[] = 'TargetProgressRel';
			}
//            $model->units = $_POST['units_to_remove'];
//
//            print_r($_POST['units_to_remove']);

			if($model->saveWithRelated($relatedTables))		
				$this->redirect(array('view','id'=>$model->target_id));
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
        $relatedTables = array();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Target']))
		{
			$model->attributes=$_POST['Target'];
//			if( $_POST['Target']['TargetActivity'] != NULL )
//			{
//				//print_r($_POST['Target']['TargetActivity'] );
//				//$model->TargetActivity = $_POST['Target']['TargetActivity'];
//				$relatedTables[] = 'TargetActivity';
//			}
//

            $model->units = $_POST['units_to_remove'];

		//	print_r($relatedTables);
			
			//try {
            try {

                if($model->saveWithRelated($relatedTables))
                {
                    if(isset($_POST['Target']['TargetProgressRel']) )
                    {

                        $model->TargetProgressRel  = $this->manageRelations($_POST['Target']['TargetProgressRel'], 1);
                        // foreach ($model->TargetProgressRel as $key => $value) {

                        // 	# code...
                        // }
                        $relatedTables[] = 'TargetProgressRel';
                        $model->saveWithRelated($relatedTables);
                    }
//
                    $this->redirect(array('view','id'=>$model->target_id));
                }
            } catch (Exception $e) {

               Yii::app()->user->setFlash('error',  $e);
            }


				
			// } catch (Exception $e) {
			// 	echo $e->getMessage();
			// }
			
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

		// $loaded->delete();
		// 	if(!isset($_GET['ajax']))
		//     	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));


		try {

			$loaded->delete();
			if(!isset($_GET['ajax']))
		    	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		} catch (Exception $e) {
			$error_message = "";
			
			foreach ($loaded->target_cannot_delete_dep as $key => $value) {
				if (strpos($e->getMessage(), $key))
					$error_message = $value;
			}

			if(!isset($_GET['ajax']))
			{
				$this->redirect(array($id, 'errorMessage'=>$error_message));// $e->getMessage();
			}else
			{
				header('HTTP/1.1 500', 'internal error');
        		echo 'Indicator "'.$loaded->name.'" cannot be deleted due to the following dependecies: '.$error_message;//html for 500 page

			} 
		}
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Target');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Target('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Target']))
			$model->attributes=$_GET['Target'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Target the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Target::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
	

	/**
	 * Performs the AJAX validation.
	 * @param Target $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='target-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
