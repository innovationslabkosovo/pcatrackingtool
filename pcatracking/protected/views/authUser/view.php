<?php
/* @var $this AuthUserController */
/* @var $model AuthUser */

$this->breadcrumbs=array(
	'Auth Users'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List AuthUser', 'url'=>array('index')),
	array('label'=>'Create AuthUser', 'url'=>array('create')),
	array('label'=>'Update AuthUser', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete AuthUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AuthUser', 'url'=>array('admin')),
);
?>

<h1>View AuthUser #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'username',
		'password',
		'first_name',
		'last_name',
		'email',
		'date_joined',
		'last_login',
		'is_superuser',
		'is_active',
	),
)); ?>
