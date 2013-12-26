<?php
/* @var $this GrantController */
/* @var $model Grant */

$this->breadcrumbs=array(
	'Grants'=>array('index'),
	$model->name=>array('view','id'=>$model->name),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Grant', 'url'=>array('index')),
	array('label'=>'Create Grant', 'url'=>array('create')),
	array('label'=>'View Grant', 'url'=>array('view', 'id'=>$model->grant_id)),
	array('label'=>'Manage Grants', 'url'=>array('admin')),
);
?>

<h4>Update Grant <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>