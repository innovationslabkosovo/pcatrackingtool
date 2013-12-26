<?php
/* @var $this LocalityController */
/* @var $model Locality */

$this->breadcrumbs=array(
	'Localities'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Locality', 'url'=>array('index')),
	array('label'=>'Create Locality', 'url'=>array('create')),
	array('label'=>'Update Locality', 'url'=>array('update', 'id'=>$model->locality_id)),
	array('label'=>'Delete Locality', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->locality_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Localities', 'url'=>array('admin')),
);
?>

<h1>View Details for <?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'locality_id',
		array(
		   'name'=>'region_id',
		   'type'=>'html',
		   'value'=>$model->region->name,),
		'name',
		'cas_village_name',
		'cad_code',
		'cas_code',
		'cas_code_un',
	),
)); ?>
