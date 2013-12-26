<?php
/* @var $this GoalController */
/* @var $model Goal */

$this->breadcrumbs=array(
	'CCCs'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Goal', 'url'=>array('index')),
	array('label'=>'Manage CCCs', 'url'=>array('admin')),
);
?>

<h1>Create CCC</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>