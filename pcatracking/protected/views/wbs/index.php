<?php
/* @var $this WbsController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("wbs/admin"));
$this->breadcrumbs=array(
	'WBS',
);

$this->menu=array(
	array('label'=>'Create WBS', 'url'=>array('create')),
	array('label'=>'Manage WBS', 'url'=>array('admin')),
);
?>

<h1>WBS</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
