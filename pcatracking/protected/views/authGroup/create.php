<?php
/* @var $this AuthGroupController */
/* @var $model AuthGroup */

$this->breadcrumbs=array(
	'Auth Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AuthGroup', 'url'=>array('index')),
	array('label'=>'Manage AuthGroup', 'url'=>array('admin')),
);
?>

<h1>Create AuthGroup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>