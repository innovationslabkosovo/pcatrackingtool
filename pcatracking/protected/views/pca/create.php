<?php
/* @var $this PcaController */
/* @var $model Pca */

$this->breadcrumbs=array(
	'PCAs'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Pca', 'url'=>array('index')),
	array('label'=>'Manage PCAs', 'url'=>array('admin')),
);

?>

<h1>Create PCA</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>