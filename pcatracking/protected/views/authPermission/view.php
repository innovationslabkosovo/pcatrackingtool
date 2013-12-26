<?php
/* @var $this AuthPermissionController */
/* @var $model AuthPermission */

$this->breadcrumbs=array(
	'Auth Permissions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AuthPermission', 'url'=>array('index')),
	array('label'=>'Create AuthPermission', 'url'=>array('create')),
	array('label'=>'Update AuthPermission', 'url'=>array('update', 'id'=>$model->permission_id)),
	array('label'=>'Delete AuthPermission', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->permission_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AuthPermission', 'url'=>array('admin')),
);
?>

<h1>View AuthPermission #<?php echo $model->permission_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'permission_id',
		'content_id',
		'type',
		'name',
	),
)); ?>
