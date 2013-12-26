<?php
/* @var $this Rrp5OutputController */
/* @var $model Rrp5Output */

$this->breadcrumbs=array(
	'RRP Outputs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage RRP Outputs', 'url'=>array('admin')),
);
?>

<h1>Create RRP Output</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>