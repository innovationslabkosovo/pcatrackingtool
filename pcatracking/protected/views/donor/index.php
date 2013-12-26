<?php
/* @var $this DonorController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("donor/admin"));
$this->breadcrumbs=array(
	'Donors',
);

$this->menu=array(
	//array('label'=>'Create Donor', 'url'=>array('create')),
	array('label'=>'Manage Donors', 'url'=>array('admin')),
);
?>

<h1>Donors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
