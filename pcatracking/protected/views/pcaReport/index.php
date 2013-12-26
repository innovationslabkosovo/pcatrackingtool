<?php
/* @var $this PcaReportController */
/* @var $dataProvider CActiveDataProvider */
 $this->redirect(array("pcaReport/admin"));
$this->breadcrumbs=array(
	'Pca Reports',
);

$this->menu=array(
	array('label'=>'Create PcaReport', 'url'=>array('create')),
	array('label'=>'Manage PcaReport', 'url'=>array('admin')),
);
?>

<h1>Pca Reports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
