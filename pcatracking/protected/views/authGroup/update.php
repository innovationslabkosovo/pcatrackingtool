<?php
/* @var $this AuthGroupController */
/* @var $model AuthGroup */

$this->breadcrumbs=array(
	'Auth Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->group_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AuthGroup', 'url'=>array('index')),
	array('label'=>'Create AuthGroup', 'url'=>array('create')),
	array('label'=>'View AuthGroup', 'url'=>array('view', 'id'=>$model->group_id)),
	array('label'=>'Manage AuthGroup', 'url'=>array('admin')),
);
?>

<h1>Update AuthGroup <?php echo $model->group_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>