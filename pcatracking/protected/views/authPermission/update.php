<?php
/* @var $this AuthPermissionController */
/* @var $model AuthPermission */

$this->breadcrumbs=array(
	'Auth Permissions'=>array('index'),
	$model->name=>array('view','id'=>$model->permission_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AuthPermission', 'url'=>array('index')),
	array('label'=>'Create AuthPermission', 'url'=>array('create')),
	array('label'=>'View AuthPermission', 'url'=>array('view', 'id'=>$model->permission_id)),
	array('label'=>'Manage AuthPermission', 'url'=>array('admin')),
);
?>

<h1>Update AuthPermission <?php echo $model->permission_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>