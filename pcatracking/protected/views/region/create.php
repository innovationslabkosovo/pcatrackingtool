<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Kadaas'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Region', 'url'=>array('index')),
	array('label'=>'Manage Kadaas', 'url'=>array('admin')),
);
?>

<h1>Create Kadaa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>