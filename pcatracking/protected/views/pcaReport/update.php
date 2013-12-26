<?php
/* @var $this PcaReportController */
/* @var $model PcaReport */
$this->redirect(array("pcaReport/".$model->pca_report_id));
$this->breadcrumbs=array(
	'Pca Reports'=>array('index'),
	$model->pca_report_id=>array('view','id'=>$model->pca_report_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List PcaReport', 'url'=>array('index')),
	array('label'=>'Create PcaReport', 'url'=>array('create')),
	array('label'=>'View PcaReport', 'url'=>array('view', 'id'=>$model->pca_report_id)),
	array('label'=>'Manage PcaReport', 'url'=>array('admin')),
);
?>

<h4>Update PcaReport <?php echo $model->pca_report_id; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>