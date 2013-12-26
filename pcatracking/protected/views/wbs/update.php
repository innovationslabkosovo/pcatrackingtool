<?php
/* @var $this WbsController */
/* @var $model Wbs */

$this->breadcrumbs=array(
	'WBS/Activity'=>array('index'),
	$model->name=>array('view','id'=>$model->wbs_id),
	'Update WBS/Activity',
);

$this->menu=array(
//	array('label'=>'List Wbs', 'url'=>array('index')),
	array('label'=>'Create WBS/Activity', 'url'=>array('create')),
	array('label'=>'View WBS/Activity', 'url'=>array('view', 'id'=>$model->wbs_id)),
	array('label'=>'Manage WBS/Activity', 'url'=>array('admin')),
);
?>

<h1>Update WBS <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>