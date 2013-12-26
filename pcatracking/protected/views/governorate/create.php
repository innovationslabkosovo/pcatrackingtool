<?php
/* @var $this GovernorateController */
/* @var $model Governorate */

$this->breadcrumbs=array(
	'Governorates'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Governorate', 'url'=>array('index')),
	array('label'=>'Manage Governorates', 'url'=>array('admin')),
);
?>

<h1>Create Governorate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>