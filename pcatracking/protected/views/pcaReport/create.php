<?php
/* @var $this PcaReportController */
/* @var $model PcaReport */

$this->breadcrumbs=array(
	'PCA Reports'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List PcaReport', 'url'=>array('index')),
	array('label'=>'Manage PCA Reports', 'url'=>array('admin')),
);
?>

<h1>Create a PCA Report</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>