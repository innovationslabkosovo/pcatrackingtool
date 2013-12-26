<?php
/* @var $this GovernorateController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("governorate/admin"));
$this->breadcrumbs=array(
	'Governorates',
);

$this->menu=array(
	array('label'=>'Create Governorate', 'url'=>array('create')),
	array('label'=>'Manage Governorates', 'url'=>array('admin')),
);
?>

<h1>Governorates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
