<?php

class PcaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $errorMessage;
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
				'actions'=>array('index','view','returnParent','gettargetbeneficiaries', 'displaySavedFile','deleteFile', 'returnLocationDiv', 'generateExcel'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>$this->getAccessLevels('pca_create'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>$this->getAccessLevels('pca_update'),
			),
			array('allow', // allow admin user to perform 'admin' actions
				'actions'=>array('admin'),
				'users'=>$this->getAccessLevels('pca_admin'),
			),
			array('allow', // allow admin user to perform 'delete' actions
				'actions'=>array('delete'),
				'users'=>$this->getAccessLevels('pca_delete'),
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pca the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pca::model()->findByPk($id);

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionGenerateExcel($id=null)
	{
		if(isset($id)) {

			$model = Pca::model()->findAll('pca_id='.$id);
			$columns_to_display = $this->getColumnstoDisplay($model, $model[0]->pca_excel_has_many_realations,
				array('pca_id', 'partner_id', 'received_date', 'is_approved', 'cash_for_supply_budget'), array('PcaFile','PcaUserActionRel'));
			$this->toExcel($model, $columns_to_display);

		} elseif (isset($_POST['hidden_excel'])) {

			$pca_ids = explode(",", $_POST['hidden_excel'][0]);
			$criteria = new CDbCriteria;
			$criteria->addInCondition('pca_id', $pca_ids);
			$model = Pca::model()->findAll($criteria);
			$columns_to_display = $this->getColumnstoDisplay($model, $model[0]->pca_excel_has_many_realations,
				array('pca_id', 'partner_id', 'received_date', 'is_approved', 'cash_for_supply_budget') , array('PcaFile','PcaUserActionRel'));
			$this->toExcel($model, $columns_to_display, get_class($model[0]));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
       $model=new Pca;
      // echo $model->pca_id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pca']))
		{

				$out;
				$relatedTables = array();
                $target_exists =false;
				$model->attributes=$_POST['Pca'];
			   // echo 22;

			if ($model->validate())
				{

					// post pca activities

					if(isset ($_POST['Pca']['PcaActivity']))
					{
						$model->PcaActivity = $_POST['Pca']['PcaActivity'];
						$relatedTables[] = 'PcaActivity';
					}

					if(isset ($_POST['Pca']['PcaSector']))
					{
						$model->PcaSector = $_POST['Pca']['PcaSector'];
						$relatedTables[] = 'PcaSector';

					}

					if(isset ($_POST['Pca']['PcaRrp5Output'] ))
					{

						$model->PcaRrp5Output = $_POST['Pca']['PcaRrp5Output'];
						$relatedTables[] = 'PcaRrp5Output';
					}

					if(isset ($_POST['Pca']['PcaGrantRel']['grant_id'][0] ))
					{
                        if ($_POST['Pca']['PcaGrantRel']['grant_id'][0] != NULL)
                        {
                            $this->transpose($_POST['Pca']['PcaGrantRel'], $grants)	;
                            $model->PcaGrantRel = $grants;
                            $relatedTables[] = 'PcaGrantRel';

                        }


					}




					if (isset ($_POST['Pca']['PcaTargetProgressRel']['total'][0] ))
					{

                        // post pca target beneficiaries
                        $model->pca_target_progress = $this->manageRelations($_POST['Pca']['PcaTargetProgressRel'], 1, $model->start_date);
                        $model->PcaTargetProgressRel = $model->pca_target_progress;
                        $target_exists =true;
                        $relatedTables[] = 'PcaTargetProgressRel';
					}


					if (isset ($_POST['Pca']['PcaWbs']))
					{
						// post pca target beneficiaries
						$model->PcaWbs = $_POST['Pca']['PcaWbs'];
                        $relatedTables[] = 'PcaWbs';
					}

//					if ($pca_files = $this->saveFiles($_FILES['UploadedFile'], $_POST['UploadedFile']) )
//					{
//						$model->PcaUFile = $pca_files;
//						$relatedTables[] = 'PcaUFile';
//					}

					if(isset($_POST['Pca']['GwPcaLocRel']['location_id'][0]))
					{
                        if ($_POST['Pca']['GwPcaLocRel']['location_id'][0] != NULL)
                        {

                            $lgw_array = array(); //location gateway array;
                            $locations = $_POST['Pca']['GwPcaLocRel']['location_id'];

                            $i=0;
                            foreach ($locations as $l_key => $l_value) {
                                $l_number = "l";
                                $l_number .= $l_key+1;
                                //echo $l_number;
                                $gateways = $_POST['Pca']['GwPcaLocRel']['gateway_id'][$l_number];
                                foreach ((array)$gateways as $gw_key => $gw_value) {
                                    //echo $l_value."-".$gw_value." / ";
                                    //$this->array_insert(&$lgw_array, $l_value, $gw_value );

                                    $lgw_array[$i]['location_id'] = $l_value;
                                    $lgw_array[$i]['gateway_id'] = $gw_value;
                                    $i++;
                                }


                            }
                             $model->GwPcaLocRel = $lgw_array;
                             $relatedTables[] = 'GwPcaLocRel';
                        }
					}


                     if (isset ($_POST['targets_to_delete']))
                         $model->targets_to_delete = $_POST['targets_to_delete'];

                if($model->saveWithRelated($relatedTables))
					{
                        // update total target progress if not empty
						if ($target_exists)
						{
							$this->updateTargetProgress('TargetProgress', $model->pca_target_progress, 1);
						}

                    // save user/pca logs
                        if ($user_id = Yii::app()->user->data()->id)
                        {
                            $pca_user = new PcaUserAction();
                            $pca_user->attributes = array('pca_id'=>$model->pca_id, 'pca_number'=>$model->number != NULL ? $model->number: "Not Set", 'pca_title'=>$model->title, 'user_id'=>$user_id, 'action'=>$this->action->id, 'datetime'=>$model->received_date);
                            $pca_user->save();
                        }

                    // save files
                        if (isset($_POST['UploadedFile']['file_category']))
                            $this->addFiles(CUploadedFile::getInstancesByName('files'), $_POST['UploadedFile']['file_category'], $model->pca_id);

                        $this->redirect(array('view','id'=>$model->pca_id));
					}
				}

		 }

		$this->render('create',array(
			'model'=>$model,

		));
	}



	function array_insert(&$array, $key, $data)
	{
	    $k = key($array);

	    if (array_key_exists($key, $array) === true)
	    {
	        $key = array_search($key, array_keys($array)) + 1;
	        $array = array_slice($array, null, $key, true) + $data + array_slice($array, $key, null, true);

	        while ($k != key($array))
	        {
	            next($array);
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
		$model_target_progress = $model->PcaTargetProgressRel ;
		$old_status = $model->status;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Pca']))
		{
            $target_exists =false;
			$relatedTables = array();
			// }// deduct targets that are not implemented from total indicator targets.
			// else if ($model->status == "canceled")
			// {

			// }

			$model->attributes=$_POST['Pca'];
			$new_status = $model->status;


			if($new_status == "canceled" && $old_status != "canceled")
			{
                if ($model_target_progress[0]['target_id'] != NULL)
                {
                    foreach ((array)$model_target_progress as $key => $value) {
                        $target_progress_row[] = array('target_id'=>$value['target_id'],'unit_id'=>$value['unit_id'],'total'=>$value['total'],'dif_total'=> -$value['total']);
                        # code...
                    }
                    $this->updateTargetProgress(TargetProgress, $target_progress_row, 0);

                }

			}else if($old_status == "canceled" && $new_status != "canceled")
			{
                if ($model_target_progress[0]['target_id'] != NULL)
                {
                    foreach ((array)$model_target_progress as $key => $value) {
                        $target_progress_row[] = array('target_id'=>$value['target_id'],'unit_id'=>$value['unit_id'],'total'=>$value['total'],'dif_total'=> $value['shortfall']);
                        # code...
                    }
				$this->updateTargetProgress(TargetProgress, $target_progress_row, 0);

                }
            }

				$model->PcaActivity = $_POST['Pca']['PcaActivity'];
				$relatedTables[] = 'PcaActivity';



				$model->PcaSector = $_POST['Pca']['PcaSector'];
				$relatedTables[] = 'PcaSector';

				//	print_r($_POST['Pca']['PcaRrp5Output']);
					//print_r($_POST['Pca']);


				$model->PcaRrp5Output = $_POST['Pca']['PcaRrp5Output'];
				$relatedTables[] = 'PcaRrp5Output';

				if ($_POST['Pca']['PcaGrantRel']['grant_id'][0] != NULL)
				{
					$this->transpose($_POST['Pca']['PcaGrantRel'], $grants)	;
					$model->PcaGrantRel = $grants;
					$relatedTables[] = 'PcaGrantRel';

				}

				if ($_POST['Pca']['PcaTargetProgressRel']['target_progress_id'][0] != NULL)
				{

					// post pca target beneficiaries
					$model->pca_target_progress = $this->manageRelations($_POST['Pca']['PcaTargetProgressRel'], 0, $model->start_date);
					$model->PcaTargetProgressRel = $model->pca_target_progress;
                    $target_exists =true;
                    $relatedTables[] = 'PcaTargetProgressRel';


				}



			$model->PcaWbs = $_POST['Pca']['PcaWbs'];
			$relatedTables[] = 'PcaWbs';

			$lgw_array = array(); //location gateway array;
            $gateways = array();

            if (isset($_POST['Pca']['GwPcaLocRel']['location_id']))
                $locations = $_POST['Pca']['GwPcaLocRel']['location_id'];


            $i=0;

            foreach ((array)$locations as $l_key => $l_value) {

                $l_number = "l";
                $l_number .= $l_key+1;

                if (isset($_POST['Pca']['GwPcaLocRel']['gateway_id'][$l_number]))
                    $gateways = $_POST['Pca']['GwPcaLocRel']['gateway_id'][$l_number];

                foreach ((array)$gateways as $gw_key => $gw_value) {
								//echo $l_value."-".$gw_value." / ";
								//$this->array_insert(&$lgw_array, $l_value, $gw_value );

                    $lgw_array[$i]['location_id'] = $l_value;
                    $lgw_array[$i]['gateway_id'] = $gw_value;
                    $i++;

                }



            }
						// $this->transpose($_POST['Pca']['GwPcaLocRel'],$gw_pca_loc);
			$model->GwPcaLocRel = $lgw_array;
			$relatedTables[] = 'GwPcaLocRel';




			$str_date_obj = new DateTime($model->start_date);
			$today = date('d-m-Y');


           // echo "memory usage on update: " . memory_get_usage(true)."\n";
			$model->targets_to_delete = $_POST['targets_to_remove'];


           
			if($model->saveWithRelated($relatedTables))
            {

				$date = date("Y-m-d H:i:s");

				//print_r($model->pca_target_progress);
//				foreach ((array)$model->pca_target_progress as $key => $value) {
//
//					$target_exists =1;
//					if (PcaTargetProgress::model()->find("pca_id = ".$model->pca_id." AND target_id=".$value['target_id']." AND unit_id=".$value['unit_id']) === null)
//					{
//						$new_target_model[$key] = new PcaTargetProgress;
//						$new_target_model[$key]->attributes = array('target_id' =>$value['target_id'],'unit_id' => $value['unit_id'],'pca_id' => $model->pca_id,'total' => $value['total'] ,'current' => $value['current'] ,'shortfall' => $value['shortfall'],'received_date'=>  $date,'active'=>1);
//						$new_target_model[$key]->save();
//
//					}else
//					{
////                        echo $value['target_id'];
////                        echo "-";
////                        echo $value['unit_id'];
////                        echo "<br/>";
//						PcaTargetProgress::model()->updateByPk(array(
//						'target_id'=> $value['target_id'],
//						'unit_id'=>$value['unit_id'],
//						'pca_id' =>  $model->pca_id,
//						'current'=>$value['current'],
//						'active'=>1),array(
//						'total'=>$value['total'],
//						'shortfall'=>$value['shortfall'],
//						)); // set existing target to inactive
//					}
//				}

				if ($target_exists)
				{
					$this->updateTargetProgress('TargetProgress', $model->pca_target_progress, 0);
				}

                if($model->targets_to_delete != NULL)
                {
                    $target_progress_model = TargetProgress::model()->findAll("target_id IN ($model->targets_to_delete)");
                    foreach ($target_progress_model as $key=>$value)
                    {
                        PcaTargetProgress::model()->deleteAll("pca_id=$model->pca_id AND target_progress_id = ".$value['target_progress_id']);
                    }

                    $this->updateTargetProgress('TargetProgress', $model->target_progress_to_update, 0);
                }


                if ($user_id = Yii::app()->user->data()->id)
                {
                    $pca_user = new PcaUserAction();
                    $pca_user->attributes = array('pca_id'=>$model->pca_id, 'pca_number'=>$model->number != NULL ? $model->number: "Not Set", 'pca_title'=>$model->title, 'user_id'=>$user_id, 'action'=>$this->action->id, 'datetime'=>$model->received_date);
                    $pca_user->save();
                }


                $this->addFiles(CUploadedFile::getInstancesByName('files'), $_POST['UploadedFile']['file_category'],$model->pca_id);


                $this->redirect(array('view','id'=>$model->pca_id));
			}
		}

		$this->render('update',array(
			'model'=>$model,

		));
	}

    public function targetsToDelete($targets)
    {

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
            if ($user_id = Yii::app()->user->data()->id)
            {
                $pca_user = new PcaUserAction();
                $pca_user->attributes = array('pca_id'=>$loaded->pca_id, 'pca_number'=>$loaded->number != NULL ? $loaded->number: "Not Set", 'pca_title'=>$loaded->title, 'user_id'=>$user_id, 'action'=>$this->action->id, 'datetime'=>$loaded->received_date);
                $pca_user->save();
            }
			if(!isset($_GET['ajax']))
		    	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		} catch (Exception $e) {
			$error_message = "";

			foreach ($loaded->pca_cannot_delete_dep as $key => $value) {
				if (strpos($e->getMessage(), $key))
					$error_message = $value;
			}

			if(!isset($_GET['ajax']))
			{
				$this->redirect(array($id, 'errorMessage'=>$error_message));// $e->getMessage();
			}else
			{
				header('HTTP/1.1 500', 'internal error');
        		echo 'PCA "'.$loaded->title.'" cannot be deleted due to the following dependecies: '.$error_message;//html for 500 page

			}
		}


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser


	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pca');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pca("search");
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pca'])){
			$model->attributes=$_GET['Pca'];

		}


		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionReturnParent()
	{

		$modelStr = $_POST['current_model'];
		$pk = $_POST['pk'];
		$name_field = $_POST['name'];
		$fk_val = $_POST['fk_val'];
		$fk_name = $_POST['fk_name'];
		$modelStr = explode(',', $modelStr);
		$pk = explode(',', $pk);
		$i=0;
		$name_to_display = "";
        $order_by = "";

		foreach ($modelStr as $modelstring) {
			# code...
			//echo $modelstring;
			switch ($modelstring)
			{

			case "goal": $model = Goal::model(); $name_to_display = "CCC";
			  break;
			case "target": $model = Target::model(); $name_to_display = "Indicator";
			  break;
			case "activity": $model = Activity::model(); $name_to_display = "no_name";
			  break;
			case "partnerOrganization": $model = PartnerOrganization::model(); $name_to_display = "Partner Organization";
			  break;
			case 'rrp5output': $model = Rrp5Output::model(); $name_to_display = "no_name";
			  break;
			case 'intermediateResult': $model = IntermediateResult::model(); $name_to_display = "Intermediate Result";
			  break;
			case 'wbs': $model = Wbs::model(); $name_to_display = "no_name";
			  break;
			case 'governorate': $model = Governorate::model(); $name_to_display = "Governorate"; $order_by = "ORDER BY name";
			  break;
			case 'region': $model = Region::model(); $name_to_display = "Kadaa";$order_by = "ORDER BY name";
			  break;
			case 'locality': $model = Locality::model(); $name_to_display = "Locality";$order_by = "ORDER BY name";
			  break;
			case 'location': $model = Location::model(); $name_to_display = "Village";$order_by = "ORDER BY name";
			  break;
			case 'grant': $model = Grant::model(); $name_to_display = "Grant Number";
			  break;

			default: echo "Problem Ocurred";
			}

			if ($name_to_display != "no_name") {
	 			echo CHtml::tag('option',
			                   array('value'=>""),CHtml::encode("Select ".$name_to_display));
	 		}
			if ($fk_val == NULL)
			{
				echo "nextitem;";
				continue;
			}

	 		$data=CHtml::listData($model->findAll($fk_name."=".$fk_val." ".$order_by),$pk[$i],$name_field);

		    foreach($data as $value=>$name)
			    {
			    	 echo CHtml::tag('option',
			                   array('value'=>$value),CHtml::encode($name),true);
			    }
			echo "nextitem;";
			$i++;
		}

	}

	public function actionReturnLocationDiv()
	{
		$region_id = $_POST['region_id'];
		$model_id = $_POST['model_id'];
		$loc_number = $_POST['loc_number'];
		$loc_number = $loc_number + 1;

		if ($region_id) $data = CHtml::listData(Location::model()->findAll("region_id=$region_id"),'location_id','name');
		else $data = CHtml::listData(Location::model()->findAll("region_id =-1"),'location_id','name');

		if ($model_id)  $model = $this->loadModel($model_id);
		else $model = new Pca;
		//print_r($model);
		return $this->widget("YumModule.components.select2.ESelect2", array(
									"model" => $model,
									"attribute" => "PcaLocation",

									"htmlOptions" => array(
										"multiple" => "multiple",
										"style" => "width:220px",
										"id" => "location".$loc_number,
										"class"=>"multiLoc"),
									"data" => $data,
									//'value' => array(8,9,11)
							)) ;
	//	echo 1;

		# code...
	}

	public function actionGetTargetBeneficiaries()
	{
        if (!isset ($_POST['target_id']) )
        {
            echo " ";

        }else
        {
            if ($_POST['target_id'] == "")
            {
                echo " ";
                return;
            }

            $target_id = $_POST['target_id'];
            $targetPrModel = TargetProgress::model()->findAll( "target_id = $target_id " );


            foreach ($targetPrModel as $key => $value) {
                echo '<div id="target_progress_'.$targetPrModel[$key]['target_progress_id'].'">';
                echo CHtml::tag('input',
                               array('type'=>'number', 'min'=> 0 , 'name'=>'Pca[PcaTargetProgressRel][total][]'),'<span>'.$targetPrModel[$key]->tpUnit['type'].'<span class="hint"> ------ Indicator Shorfall: '.$targetPrModel[$key]['shortfall'].' </span></span></br>');
                echo CHtml::tag('input',
                               array('type'=>'hidden','value'=>$targetPrModel[$key]['target_progress_id'],'name'=>'Pca[PcaTargetProgressRel][target_progress_id][]'));
//                echo CHtml::tag('input',
//                               array('type'=>'hidden','value'=>$targetPrModel[$key]['unit_id'],'name'=>'Pca[PcaTargetProgressRel][unit_id][]'));
//                echo CHtml::tag('input',
//                               array('type'=>'hidden','value'=>$targetPrModel[$key]['target_id'],'name'=>'Pca[PcaTargetProgressRel][target_id][]'));
                echo CHtml::tag('input',
                               array('type'=>'hidden','value'=>$targetPrModel[$key]['shortfall'],'name'=>'Pca[PcaTargetProgressRel][target_shortfall][]'));
//                echo CHtml::tag('input',
//                                   array('type'=>'hidden','value'=>1,'name'=>'Pca[PcaTargetProgressRel][active][]'));
                echo CHtml::tag('input',
                    array('type'=>'hidden','id'=> 'hidden_is_new', 'value'=>1,'name'=>'Pca[PcaTargetProgressRel][is_new][]'));
                echo CHtml::tag('input',
                    array('type'=>'hidden','value'=> date("Y-m-d H:i:s"),'name'=>'Pca[PcaTargetProgressRel][received_date][]'));
                echo '</div>';

                }

        }	//;
			//$targetPrModel[$key]['total'];
			//$targetPrModel[$key]['shortfall'];


	}

    public function addFiles($files, $file_categories, $pca_id)
    {
        // $files = CUploadedFile::getInstancesByName('files');
        // $file_categories = $_POST['UploadedFile']['file_category'];

        // proceed if the images have been set
        if (isset($files) && count($files) > 0) {

            if(!is_dir(Yii::getPathOfAlias('webroot').'/protected/files/pcas/'. $pca_id))
            {
                mkdir(Yii::getPathOfAlias('webroot').'/protected/files/pcas/'. $pca_id);
                chmod(Yii::getPathOfAlias('webroot').'/protected/files/pcas/'. $pca_id, 0755);
            }

            // go through each uploaded file
            foreach ($files as $file_key => $file_value) {
                if(!is_dir(Yii::getPathOfAlias('webroot').'/protected/files/pcas/'. $pca_id.'/'.$file_categories[$file_key]))
                {
                    mkdir(Yii::getPathOfAlias('webroot').'/protected/files/pcas/'.$pca_id.'/'.$file_categories[$file_key]);
                    chmod(Yii::getPathOfAlias('webroot').'/protected/files/pcas/'. $pca_id.'/'.$file_categories[$file_key], 0755);
                }


                if ($file_value->saveAs(Yii::getPathOfAlias('webroot').'/protected/files/pcas/'. $pca_id.'/'.$file_categories[$file_key].'/'.$file_value->name)) {
                    // add it to the main model now
                    $pca_file_add = new PcaFile();
                    $pca_file_add->file_name = $file_value->name; //it might be $img_add->name for you, filename is just what I chose to call it in my model
                    $pca_file_add->pca_id= $pca_id; // this links your picture model to the main model (like your user, or profile model)
                    $pca_file_add->file_category = $file_categories[$file_key];

                    $pca_file_add->save(); // DONE
                }
                else
                {
                    echo 'Cannot upload!';

                }

            }


        }
    }

	public function saveFiles($files, $categories)
	{

		$file_objs = array();	
		$this->transpose($files,$out);
		
		// print_r($out);
		$pca_file_keys= array();
		//print_r($out);
		foreach ((array)$out as $key => $value) {
			$file_objs[$key] = new UploadedFile;

		
			if($file=CUploadedFile::getInstance($file_objs[$key], "file_content[$key]" ))
			{

				
				$file_objs[$key]->file_name=$file->name;
	            $file_objs[$key]->file_type=$file->type;
	            $file_objs[$key]->file_size=$file->size;
	            $file_objs[$key]->file_content=file_get_contents($file->tempName);
	        	$file_objs[$key]->file_category=$categories['file_category'][$key];

	        	     	
	        	if ($file_objs[$key]->save(false))
	        		{
	        			$pca_file_keys[$key] = $file_objs[$key]->file_id;
	        		}

	        }	
			# code...
		}
		
		return $pca_file_keys;
	}

	public function actionDisplaySavedFile()
	{

        $pca_id = $_GET['pca_id'];
        $file_category = $_GET['file_category'];
        $file_name = $_GET['file_name'];

        $file = Yii::getPathOfAlias('webroot').'/protected/files/pcas/'. $pca_id.'/'.$file_category.'/'.$file_name;

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
        else
        {
            echo "File Not Found !";
        }
	}

    public function actionDeleteFile($pca_id)
    {

       // $pca_id = $_POST['pca_id'];
        $file_category = $_POST['file_category'];
        $file_name = $_POST['file_name'];
        $file_id = $_POST['file_id'];

        $file = Yii::getPathOfAlias('webroot').'/protected/files/pcas/'. $pca_id.'/'.$file_category.'/'.$file_name;
        if(is_file($file))
            if (unlink($file))// delete file
            {
                PcaFile::model()->DeleteByPk($file_id);
                echo "File ".$file_name." Deleted !,true";
            }
            else
                echo "File ".$file_name." Could not be Deleted !,false";
        else echo "File not found!,false";

    }

	// public function updatePcaTargetProgressRel ($totalPcaTarget)
	// {
	// 	$updateTarget = TargetProgress::model();
	// 	$newTarget = new TargetProgress;
	// 	$return = 1;

	// 	foreach ($totalPcaTarget as $key => $value) {
					
	// 				$target_id = $totalPcaTarget[$key]['target_id'];
	// 				$unit_id = $totalPcaTarget[$key]['unit_id'];
	// 				$pca_id = $totalPcaTarget[$key]['pca_id'];
					
	// 				$existingTargetProgress = $updateTarget->findAll( "target_id = $target_id  AND unit_id = $unit_id AND pca_id = $pca_id AND received_date IN (select target_shortfall(received_date) from tbl_target_progress WHERE target_id = $target_id  AND unit_id = $unit_id )");

					
	// 				$total = $existingTargetProgress[0]['total'];
	// 				$programmed = $existingTargetProgress[0]['programmed'] + $totalPcaTarget[$key]['total'];
	// 				$shortfall = $total - $programmed;
	// 				$date = date("Y-m-d H:i:s");
					
	// 				$targetProgressModel = $newTarget;
	// 				$targetProgressModel->attributes = array('target_id' =>$totalPcaTarget[$key]['target_id'],'unit_id' => $totalPcaTarget[$key]['unit_id'],'pca_id' => $totalPcaTarget[$key]['pca_id'],'total' => $total,'programmed' => $programmed,'shortfall' => $shortfall,'received_date'=>  $date);
				
	// 				if (!$targetProgressModel->save())
	// 					$return = 0;						
	// 			}
	// 	return $return;	
	// }

	/**
	 * Performs the AJAX validation.
	 * @param Pca $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pca-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	// public function getActivities()
	// {
	// 	$activities =implode('<br/>',new PCA ('getRelatedActivities')); 
	// 	return; 
	// }
}
