<?php
/* @var $this LocalityController */
/* @var $model Locality */

$this->breadcrumbs=array(
	'Localities'=>array('index'),
	$model->name=>array('view','id'=>$model->locality_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Locality', 'url'=>array('index')),
	array('label'=>'Create Locality', 'url'=>array('create')),
	array('label'=>'View Locality', 'url'=>array('view', 'id'=>$model->locality_id)),
	array('label'=>'Manage Localities', 'url'=>array('admin')),
);
?>

<h1>Update Details for <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>