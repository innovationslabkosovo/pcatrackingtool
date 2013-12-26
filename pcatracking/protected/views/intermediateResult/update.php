<?php
/* @var $this IntermediateResultController */
/* @var $model IntermediateResult */

$this->breadcrumbs=array(
	'Intermediate Results'=>array('index'),
	$model->name=>array('view','id'=>$model->ir_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List IntermediateResult', 'url'=>array('index')),
	array('label'=>'Create Intermediate Result', 'url'=>array('create')),
	array('label'=>'View Intermediate Result', 'url'=>array('view', 'id'=>$model->ir_id)),
	array('label'=>'Manage Intermediate Results', 'url'=>array('admin')),
);
?>

<h4>Update IR <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>