<?php
/* @var $this GoalController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("goal/admin"));
$this->breadcrumbs=array(
	'CCCs',
);

$this->menu=array(
	array('label'=>'Create CCC', 'url'=>array('create')),
	array('label'=>'Manage CCCs', 'url'=>array('admin')),
);
?>

<h1>CCCs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
