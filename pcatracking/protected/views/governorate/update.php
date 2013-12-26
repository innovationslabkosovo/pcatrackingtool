<?php
/* @var $this GovernorateController */
/* @var $model Governorate */

$this->breadcrumbs=array(
	'Governorates'=>array('index'),
	$model->name=>array('view','id'=>$model->governorate_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Governorate', 'url'=>array('index')),
	array('label'=>'Create Governorate', 'url'=>array('create')),
	array('label'=>'View Governorates', 'url'=>array('view', 'id'=>$model->governorate_id)),
	array('label'=>'Manage Governorates', 'url'=>array('admin')),
);
?>

<h4>Update Governorate <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>