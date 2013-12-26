<?php
/* @var $this AuthGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Auth Groups',
);

$this->menu=array(
	array('label'=>'Create AuthGroup', 'url'=>array('create')),
	array('label'=>'Manage AuthGroup', 'url'=>array('admin')),
);
?>

<h1>Auth Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
