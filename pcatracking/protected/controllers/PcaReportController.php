<?php

class PcaReportController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'returnBeneficiaries', 'returnSectorPcas', 'displayPcaReportFile', 'deleteFile'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create'),
                'users' => $this->getAccessLevels('pcaReport_create'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update'),
                'users' => $this->getAccessLevels('pcaReport_update'),
            ),
            array('allow', // allow admin user to perform 'admin' actions
                'actions' => array('admin'),
                'users' => $this->getAccessLevels('pcaReport_admin'),
            ),
            array('allow', // allow admin user to perform 'delete' actions
                'actions' => array('delete'),
                'users' => $this->getAccessLevels('pcaReport_delete'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new PcaReport;
        $relatedTables = array();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PcaReport'])) {
            $model->attributes = $_POST['PcaReport'];


            //post pca target beneficiaries
            //$relations = $this->manageRelations($_POST['Pca']['PcaTargetProgressRel'], 1);

            if (!empty($_POST['PcaReport']['TargetProgressPcaReportRel']))
            {
                $this->transpose($_POST['PcaReport']['TargetProgressPcaReportRel'], $out); // unset null totals
                $model->TargetProgressPcaReportRel = $out;
                //	print_r($model->TargetProgressPcaReportRel );
                $relatedTables[] = 'TargetProgressPcaReportRel';

            }



            if ($model->saveWithRelated($relatedTables)) {
                if (in_array('TargetProgressPcaReportRel', $relatedTables))
                {
                    $this->transpose($_POST['PcaReport']['TargetProgressPcaReportRel'], $out);

                    $this->updatePcaTargetProgress(PcaTargetProgress, $out);

                }


//                    if (isset($_POST['files']))
//                       echo "exists";
//                    else echo "empty";
//                    exit;
                try {
                    $this->addFiles(CUploadedFile::getInstancesByName('files'), $model->pca_report_id);
                } catch (Exception $e) {


                }
                //

                $this->redirect(array('view', 'id' => $model->pca_report_id));

            }

        }

        $this->render('create', array(
            'model' => $model,
        ));
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PcaReport'])) {
            $model->attributes = $_POST['PcaReport'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->pca_report_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $pca_report_id = $model->pca_report_id;
        $pca_file = $model->PcaReportFile;
        $update_pca_progress = array();
        foreach ((array)$model->TargetProgressPcaReportRel as $key => $value) {
            $update_pca_progress[$key]['total'] = -$value['total'];
            $update_pca_progress[$key]['pca_target_progress_id'] = $value['pca_target_progress_id'];

        }

        if (!empty($update_pca_progress))
        {
            //print_r($update_pca_progress);
            $this->updatePcaTargetProgress(PcaTargetProgress, $update_pca_progress);
        }

        //exit;

        if ($model->delete())
        {
            if (!empty($pca_file))
             $this->deleteFileFolder($pca_report_id);

        }


        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('PcaReport');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new PcaReport('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['PcaReport']))
            $model->attributes = $_GET['PcaReport'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PcaReport the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = PcaReport::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionReturnBeneficiaries()
    {

        $pca_id = $_POST['pca_id'];
        //$targets = array();
        //	echo $pca_id;
        $pca_report_progress = PcaTargetProgress::model()->findAll(array('order' => 'target_progress_id', 'condition' => 'pca_id=' . $pca_id));
        //	print_r($pca_report_progress);
        foreach ($pca_report_progress as $key => $value) {
            //$value['target_name'] = Target::model()->find(array( 'select'=>'name', 'condition'=>'target_id='.$value['target_id']));
            //echo $value['target_name'];
            //	$value['unit_name'] =

//            $targets[$key]['target_id'] = $value['target_id'];
//            $targets[$key]['unit_id'] = $value['unit_id'];
            $targets[$key]['pca_target_progress_id'] = $value['pca_target_progress_id'];
            $targets[$key]['total'] = $value['total'];
            $targets[$key]['shortfall'] = $value['shortfall'];
            $targets[$key]['current'] = $value['current'];
            $targets[$key]['target_name'] = $value->tpTarget->tpTarget->name;
            $targets[$key]['unit_name'] = $value->tpTarget->tpUnit->type;

        }
        echo CJSON::encode($targets);
        # code...
    }

    public function actionReturnSectorPcas()
    {
        if (isset ($_POST['sector_id'])) {
            $sector_id = $_POST['sector_id'];

            $criteria = new CDbCriteria;
            $criteria->select = 'pca.pca_id, pca.number, pca.title ';
            $criteria->join = 'LEFT JOIN tbl_pca_sector as ps ON ps.pca_id=pca.pca_id';
            $criteria->condition = 'sector_id=:sector_id';
            $criteria->params = array(':sector_id' => $sector_id);
            $pcas = Pca::model()->findAll($criteria);

            foreach ($pcas as $key => $value) {
                echo($value['title']);
                echo CHtml::tag('option',
                    array('value' => $value['pca_id']), CHtml::encode($value['number'] . " - " . $value['title']), true);
            }

        } else {
            echo "";
        }


    }

    public function addFiles($files, $pca_report_id)
    {
        // $files = CUploadedFile::getInstancesByName('files');
        // $file_categories = $_POST['UploadedFile']['file_category'];

        // proceed if the images have been set
        if (isset($files) && count($files) > 0) {

            if (!is_dir(Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id)) {
                mkdir(Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id);
                chmod(Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id, 0755);
            }

            // go through each uploaded file
            foreach ($files as $file_key => $file_value) {
                if (!is_dir(Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id)) {
                    mkdir(Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id);
                    chmod(Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id, 0755);
                }


                if ($file_value->saveAs(Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id . '/' . $file_value->name)) {
                    // add it to the main model now
                    $pca_file_add = new PcaReportFile();
                    $pca_file_add->file_name = $file_value->name; //it might be $img_add->name for you, filename is just what I chose to call it in my model
                    $pca_file_add->pca_report_id = $pca_report_id; // this links your picture model to the main model (like your user, or profile model)

                    ($pca_file_add->save());


                } else {
                    echo 'Cannot upload!';

                }

            }


        }
    }

    public function deleteFileFolder($pca_report_id)
    {
        $dir = Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id ;
        print_r($dir);
        exit;
        if (!empty($dir))
        {
            $it = new RecursiveDirectoryIterator($dir);
            $files = new RecursiveIteratorIterator($it,
                RecursiveIteratorIterator::CHILD_FIRST);
            foreach($files as $file) {
                if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                    continue;
                }
                if ($file->isDir()){
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($dir);

        }

    }

    public function actionDeleteFile($pca_report_id)
    {

        $file_name = $_POST['file_name'];
        $file_id = $_POST['file_id'];

        $file = Yii::getPathOfAlias('webroot') . '/protected/files/pcaReports/' . $pca_report_id . '/' . $file_name;
        if (is_file($file))
            if (unlink($file)) // delete file
            {
                PcaReportFile::model()->DeleteByPk($file_id);
                echo "File " . $file_name . " Deleted !,true";
            } else
                echo "File " . $file_name . " Could not be Deleted !,false";
        else echo "File not found!,false";

    }

    public function actionDisplayPcaReportFile()
    {

        $pca_report_id = $_GET['pca_report_id'];
        $file_name = $_GET['file_name'];

        $file = Yii::getPathOfAlias('webroot').'/protected/files/pcaReports/'. $pca_report_id.'/'.$file_name;

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

    /**
     * Performs the AJAX validation.
     * @param PcaReport $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pca-report-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


}
