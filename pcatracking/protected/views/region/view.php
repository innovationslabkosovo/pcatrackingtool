<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Kadaa'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Regions', 'url'=>array('index')),
	array('label'=>'Create Kadaa', 'url'=>array('create')),
	array('label'=>'Update Kadaa', 'url'=>array('update', 'id'=>$model->region_id)),
	array('label'=>'Delete Kadaa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->region_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kadaas', 'url'=>array('admin')),
);

if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Kadaa <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
	 $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); 
	
}

?>

<h4>Kadaa: <?php echo $model->name; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		array(
		   'name'=>'governorate',
		   'type'=>'html',
		   'value'=>$model->governorate->name,),	
		//'region_id',
		'name',
	),
)); ?>
