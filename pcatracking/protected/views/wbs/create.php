<?php
/* @var $this WbsController */
/* @var $model Wbs */

$this->breadcrumbs=array(
	'WBS/Activity'=>array('index'),
	'Create WBS/Activity',
);

$this->menu=array(
//	array('label'=>'List Wbs', 'url'=>array('index')),
	array('label'=>'Manage WBS/Activity', 'url'=>array('admin')),
);
?>

<h1>Create WBS/Activity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>