<?php
/* @var $this UnitController */
/* @var $model Unit */

$this->breadcrumbs=array(
	'Units'=>array('index'),
	$model->unit_id=>array('view','id'=>$model->unit_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Unit', 'url'=>array('index')),
	array('label'=>'Create Unit', 'url'=>array('create')),
	array('label'=>'View Unit', 'url'=>array('view', 'id'=>$model->unit_id)),
	array('label'=>'Manage Unit', 'url'=>array('admin')),
);
?>

<h4>Update Unit <?php echo $model->unit_id; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>