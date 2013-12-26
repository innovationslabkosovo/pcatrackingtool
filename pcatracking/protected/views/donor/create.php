<?php
/* @var $this DonorController */
/* @var $model Donor */

$this->breadcrumbs=array(
	'Donors'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Donor', 'url'=>array('index')),
	array('label'=>'Manage Donors', 'url'=>array('admin')),
);
?>

<h1>Create Donor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>