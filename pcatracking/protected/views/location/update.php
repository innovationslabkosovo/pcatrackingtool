<?php
/* @var $this VillageController */
/* @var $model Village */

$this->breadcrumbs=array(
	'Villages'=>array('index'),
	$model->name=>array('view','id'=>$model->location_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Village', 'url'=>array('index')),
	array('label'=>'Create Village', 'url'=>array('create')),
	array('label'=>'View Village', 'url'=>array('view', 'id'=>$model->location_id)),
	array('label'=>'Manage Villages', 'url'=>array('admin')),
);
?>

<h4>Update Details for <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>