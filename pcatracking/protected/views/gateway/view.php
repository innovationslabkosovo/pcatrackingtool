<?php
/* @var $this GatewayController */
/* @var $model Gateway */

$this->breadcrumbs=array(
	'Gateways'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Gateway', 'url'=>array('index')),
	array('label'=>'Create Gateway', 'url'=>array('create')),
	array('label'=>'Update Gateway', 'url'=>array('update', 'id'=>$model->gateway_id)),
	array('label'=>'Delete Gateway', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->gateway_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gateways', 'url'=>array('admin')),
);


if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Gateway <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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

<h4>Gateway: <?php echo $model->name; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'gateway_id',
		'name',
	),
)); ?>
