<?php
/* @var $this GoalController */
/* @var $model Goal */

$this->breadcrumbs=array(
	'CCCs'=>array('index'),
	$model->goal_id=>array('view','id'=>$model->goal_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Goal', 'url'=>array('index')),
	array('label'=>'Create CCC', 'url'=>array('create')),
	array('label'=>'View CCC', 'url'=>array('view', 'id'=>$model->goal_id)),
	array('label'=>'Manage CCCs', 'url'=>array('admin')),
);
?>

<h4>Update <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>