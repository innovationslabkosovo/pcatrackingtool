<?php
/* @var $this IntermediateResultController */
/* @var $model IntermediateResult */

$this->breadcrumbs=array(
	'Intermediate Results'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List IntermediateResult', 'url'=>array('index')),
	array('label'=>'Manage Intermediate Results', 'url'=>array('admin')),
);
?>

<h1>Create Intermediate Result</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>