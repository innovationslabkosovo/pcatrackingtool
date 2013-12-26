<?php
/* @var $this ContentTypeController */
/* @var $model ContentType */

$this->breadcrumbs=array(
	'Content Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContentType', 'url'=>array('index')),
	array('label'=>'Manage ContentType', 'url'=>array('admin')),
);
?>

<h1>Create ContentType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>