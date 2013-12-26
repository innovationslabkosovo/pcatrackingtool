<?php

class PartnerOrganizationController extends Controller
{
	protected $relatedTables = array();
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
		//This is for exporting one Partner Organization only - the one being viewed currently
		if(isset($id)) {

			$model = PartnerOrganization::model()->findAll('partner_id='.$id);
			$columns_to_display = $this->getColumnstoDisplay($model, $model[0]->partner_excel_has_many_realations, array('partner_id'), array('tblActivities'));
			$this->toExcel($model, $columns_to_display, get_class($model[0]));

		} 
		//This is to export the currently filtered Partner Organizations 
		elseif (isset($_POST['hidden_excel'])) {
			
			$partner_ids = explode(",", $_POST['hidden_excel'][0]); 
			$criteria = new CDbCriteria;
			$criteria->addInCondition('partner_id', $partner_ids);
			$model = PartnerOrganization::model()->findAll($criteria);
			//$columns_to_display = $this->getColumnstoDisplay($model, array('number', 'title', 'start_date', 'end_date'), array('partner_id'));
			$columns_to_display = $this->getColumnstoDisplay($model, $model[0]->partner_excel_has_many_realations, array('partner_id'), array('tblActivities'));
			$this->toExcel($model, $columns_to_display, get_class($model[0]));	
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PartnerOrganization;
		//$removeWidget = 1;
		//$this->performAjaxValidation($model);
		// Uncomment the following line if AJAX validation is needed
		
		if (Yii::app()->request->isAjaxRequest) 
		{				
			$dialog_flag = TRUE;
		}

		if(isset($_POST['PartnerOrganization']))
		{
			
		
			$model->attributes=$_POST['PartnerOrganization'];
			
			if($_POST['PartnerOrganization']['tblLocations'] != NULL)				
			{
				$model->tblLocations = $_POST['PartnerOrganization']['tblLocations'];
				$relatedTables[] = 'tblLocations';
			}
		

			if($model->saveWithRelated($relatedTables))
			{
				//echo 'check'.$_POST['dialog_flag'];
				if($_POST['dialog_flag']){	

					 echo CHtml::tag('option',array (
                                'value'=>$model->partner_id,
                                'selected'=>true
                            ),CHtml::encode($model->name),true);

				}else $this->redirect(array('view','id'=>$model->partner_id));
			}
			
		}else
		{
			if($dialog_flag)
			{
			    $this->render('_form',array('model'=>$model,'dialog_flag'=>$dialog_flag),false,true);
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

		if(isset($_POST['PartnerOrganization']))
		{
			$model->attributes=$_POST['PartnerOrganization'];
		
			$model->tblLocations = $_POST['PartnerOrganization']['tblLocations'];	
			$relatedTables[] = 'tblLocations';

			if($model->saveWithRelated($relatedTables))
				$this->redirect(array('view','id'=>$model->partner_id));
		}

		$this->render('update',array(
			'model'=>$model,
			'flag'=>true,
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
			
			foreach ($loaded->partner_cannot_delete_dep as $key => $value) {
				if (strpos($e->getMessage(), $key))
					$error_message = $value;
			}

			if(!isset($_GET['ajax']))
			{
				$this->redirect(array($id, 'errorMessage'=>$error_message));// $e->getMessage();
			}else
			{
				header('HTTP/1.1 500', 'internal error');
        		echo 'Partner Organization "'.$loaded->name.'" cannot be deleted due to the following dependecies: '.$error_message;//html for 500 page

			} 
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PartnerOrganization');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PartnerOrganization('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PartnerOrganization']))
			$model->attributes=$_GET['PartnerOrganization'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PartnerOrganization the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PartnerOrganization::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		// if ($this->getRelatedModels($model->tblActivities, array('activity_id', 'name')) != NULL){
		// $model->tblActivities = $this->getRelatedModels($model->tblActivities, array('activity_id', 'name'));
		// }

		// if ($this->getRelatedModels($model->tblLocations, array('location_id', 'name')) != NULL){
		// $model->tblLocations = $this->getRelatedModels($model->tblLocations, array('location_id', 'name'));
		// }
		
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PartnerOrganization $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='partner-organization-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
