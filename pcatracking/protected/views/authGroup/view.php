<?php
/* @var $this AuthGroupController */
/* @var $model AuthGroup */

$this->breadcrumbs=array(
	'Auth Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AuthGroup', 'url'=>array('index')),
	array('label'=>'Create AuthGroup', 'url'=>array('create')),
	array('label'=>'Update AuthGroup', 'url'=>array('update', 'id'=>$model->group_id)),
	array('label'=>'Delete AuthGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->group_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AuthGroup', 'url'=>array('admin')),
);
?>

<h1>View AuthGroup #<?php echo $model->group_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'group_id',
		'name',
	),
)); ?>
