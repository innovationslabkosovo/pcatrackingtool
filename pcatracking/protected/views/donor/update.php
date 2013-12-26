<?php
/* @var $this DonorController */
/* @var $model Donor */

$this->breadcrumbs=array(
	'Donors'=>array('index'),
	$model->name=>array('view','id'=>$model->donor_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Donor', 'url'=>array('index')),
	array('label'=>'Create Donor', 'url'=>array('create')),
	array('label'=>'View Donor', 'url'=>array('view', 'id'=>$model->donor_id)),
	array('label'=>'Manage Donors', 'url'=>array('admin')),
);
?>

<h4>Update <?php echo $model->name; ?> Donor details</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>