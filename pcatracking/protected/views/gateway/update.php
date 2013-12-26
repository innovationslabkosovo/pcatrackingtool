<?php
/* @var $this GatewayController */
/* @var $model Gateway */

$this->breadcrumbs=array(
	'Gateways'=>array('index'),
	$model->name=>array('view','id'=>$model->gateway_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Gateway', 'url'=>array('index')),
	array('label'=>'Create Gateway', 'url'=>array('create')),
	array('label'=>'View Gateway', 'url'=>array('view', 'id'=>$model->gateway_id)),
	array('label'=>'Manage Gateways', 'url'=>array('admin')),
);
?>

<h4>Update Gateway <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>