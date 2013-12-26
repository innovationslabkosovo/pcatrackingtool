<?php
/* @var $this GrantController */
/* @var $model Grant */

$this->breadcrumbs=array(
	'Grants'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Grant', 'url'=>array('index')),
	array('label'=>'Manage Grants', 'url'=>array('admin')),
);
?>

<h1>Create Grant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>