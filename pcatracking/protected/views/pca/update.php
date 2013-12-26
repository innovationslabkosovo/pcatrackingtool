<?php
/* @var $this PcaController */
/* @var $model Pca */

$this->breadcrumbs=array(
	'Pcas'=>array('index'),
	$model->pca_id=>array('view','id'=>$model->pca_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Pca', 'url'=>array('index')),
	array('label'=>'Create PCA', 'url'=>array('create')),
	array('label'=>'View PCA', 'url'=>array('view', 'id'=>$model->pca_id)),
	array('label'=>'Manage PCAs', 'url'=>array('admin')),
);
?>

<h4>Update PCA <?php echo $model->title; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>