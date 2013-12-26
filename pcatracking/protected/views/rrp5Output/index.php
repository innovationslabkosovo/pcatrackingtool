<?php
/* @var $this Rrp5OutputController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("rrp5Output/admin"));
$this->breadcrumbs=array(
	'Rrp Outputs',
);

$this->menu=array(
	array('label'=>'Create RRP Output', 'url'=>array('create')),
	array('label'=>'Manage RRP Outputs', 'url'=>array('admin')),
);
?>

<h1>RRP Outputs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
