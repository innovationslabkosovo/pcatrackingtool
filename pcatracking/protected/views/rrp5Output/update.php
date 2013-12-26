<?php
/* @var $this Rrp5OutputController */
/* @var $model Rrp5Output */

$this->breadcrumbs=array(
	'Rrp Outputs'=>array('index'),
	$model->name=>array('view','id'=>$model->rrp5_output_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List RRP5 Outputs', 'url'=>array('index')),
	array('label'=>'Create RRP Output', 'url'=>array('create')),
	array('label'=>'View RRP Outputs', 'url'=>array('view', 'id'=>$model->rrp5_output_id)),
	array('label'=>'Manage RRP Outputs', 'url'=>array('admin')),
);
?>

<h4>Update RRP Output <?php echo $model->rrp5_output_id; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>