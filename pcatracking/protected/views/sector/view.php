<?php
/* @var $this SectorController */
/* @var $model Sector */

$this->breadcrumbs=array(
	'Sectors'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Sector', 'url'=>array('index')),
	array('label'=>'Create Sector', 'url'=>array('create')),
	array('label'=>'Update Sector', 'url'=>array('update', 'id'=>$model->sector_id)),
	array('label'=>'Delete Sector', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sector_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sectors', 'url'=>array('admin')),
);


if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Sector <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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

<h4><?php echo $model->name; ?> Sector</h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'sector_id',
		'name',
		'description',
	),
)); ?>
