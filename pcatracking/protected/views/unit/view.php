<?php
/* @var $this UnitController */
/* @var $model Unit */

$this->breadcrumbs=array(
	'Units'=>array('index'),
	$model->unit_id,
);

$this->menu=array(
	//array('label'=>'List Unit', 'url'=>array('index')),
	array('label'=>'Create Unit', 'url'=>array('create')),
	array('label'=>'Update Unit', 'url'=>array('update', 'id'=>$model->unit_id)),
	array('label'=>'Delete Unit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->unit_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Units', 'url'=>array('admin')),
);

if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Unit <strong>'.$model->type.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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

<h4>Unit: <?php echo $model->unit_id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'unit_id',
		'type',
	),
)); ?>
