<?php
/* @var $this ActivityController */
/* @var $model Activity */

$this->breadcrumbs=array(
	'Activities'=>array('index'),
	$model->name=>array('view','id'=>$model->activity_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Activity', 'url'=>array('index')),
	array('label'=>'Create Activity', 'url'=>array('create')),
	array('label'=>'View Activity', 'url'=>array('view', 'id'=>$model->activity_id)),
	array('label'=>'Manage Activities', 'url'=>array('admin')),
);
?>

<h4>Update <?php echo $model->name; ?> Activity</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>