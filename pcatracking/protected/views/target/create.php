<?php
/* @var $this TargetController */
/* @var $model Target */

$this->breadcrumbs=array(
	'Indicators'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Target', 'url'=>array('index')),
	array('label'=>'Manage Indicators', 'url'=>array('admin')),
);
?>

<h1>Create Indicator</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>