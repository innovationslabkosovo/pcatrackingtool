<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Kadaa'=>array('index'),
	$model->name=>array('view','id'=>$model->region_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Regions', 'url'=>array('index')),
	array('label'=>'Create Kadaa', 'url'=>array('create')),
	array('label'=>'View Kadaa', 'url'=>array('view', 'id'=>$model->region_id)),
	array('label'=>'Manage Kadaas', 'url'=>array('admin')),
);
?>

<h4>Update Details for <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>