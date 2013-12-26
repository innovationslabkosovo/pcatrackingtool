<?php
/* @var $this SectorController */
/* @var $model Sector */

$this->breadcrumbs=array(
	'Sectors'=>array('index'),
	$model->name=>array('view','id'=>$model->sector_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Sector', 'url'=>array('index')),
	array('label'=>'Create Sector', 'url'=>array('create')),
	array('label'=>'View Sector', 'url'=>array('view', 'id'=>$model->sector_id)),
	array('label'=>'Manage Sectors', 'url'=>array('admin')),
);
?>

<h4>Update Sector <?php echo $model->sector_id; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>