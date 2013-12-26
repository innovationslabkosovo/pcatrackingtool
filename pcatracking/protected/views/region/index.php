<?php
/* @var $this RegionController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("region/admin"));
$this->breadcrumbs=array(
	'Regions',
);

$this->menu=array(
	array('label'=>'Create Region', 'url'=>array('create')),
	array('label'=>'Manage Regions', 'url'=>array('admin')),
);
?>

<h1>Regions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
