<?php
/* @var $this GrantController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("grant/admin"));
$this->breadcrumbs=array(
	'Grants',
);

$this->menu=array(
	array('label'=>'Create Grant', 'url'=>array('create')),
	array('label'=>'Manage Grant', 'url'=>array('admin')),
);
?>

<h1>Grants</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
