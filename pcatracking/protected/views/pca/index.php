<?php
/* @var $this PcaController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("pca/admin"));
$this->breadcrumbs=array(
	'PCAs',
);

$this->menu=array(
	array('label'=>'Create PCA', 'url'=>array('create')),
	array('label'=>'Manage PCAs', 'url'=>array('admin')),
);
?>

<h1>PCAs</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'template' => "{summary}\n{pager}\n{items}\n{summary}\n{pager}",
	'itemView'=>'_view',
	
)); ?>
