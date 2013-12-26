<?php
/* @var $this VillageController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("location/admin"));
$this->breadcrumbs=array(
	'Villages',
);

$this->menu=array(
	array('label'=>'Create Village', 'url'=>array('create')),
	array('label'=>'Manage Villages', 'url'=>array('admin')),
);
?>

<h1>Villages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>