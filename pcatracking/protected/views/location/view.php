<?php
/* @var $this VillageController */
/* @var $model Village */

$this->breadcrumbs=array(
	'Villages'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Village', 'url'=>array('index')),
	array('label'=>'Create Village', 'url'=>array('create')),
	array('label'=>'Update Village', 'url'=>array('update', 'id'=>$model->location_id)),
	array('label'=>'Delete Village', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->location_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Villages', 'url'=>array('admin')),
);
?>

<h4>View Details for <?php echo $model->name; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'location_id',
		array(
		   'name'=>'governorate',
		   'value'=>$model->locality->region->governorate->name,),	
		array(
		   'name'=>'region',
		   'value'=>$model->locality->region->name,),	
		array(
		   'name'=>'locality',
		   'value'=>$model->locality->name,),	
		'name',
		'p_code',
		'latitude',
		'longitude',
	),
)); ?>
