<?php
/* @var $this IntermediateResultController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("IntermediateResult/admin"));
$this->breadcrumbs=array(
	'Intermediate Results',
);

$this->menu=array(
	array('label'=>'Create IntermediateResult', 'url'=>array('create')),
	array('label'=>'Manage IntermediateResult', 'url'=>array('admin')),
);
?>

<h1>Intermediate Results</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'template' => "{summary}\n{pager}\n{items}\n{summary}\n{pager}",
	'itemView'=>'_view',
	
)); ?>
