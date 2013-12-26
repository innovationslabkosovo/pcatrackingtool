<?php
/* @var $this SectorController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("sector/admin"));
$this->breadcrumbs=array(
	'Sectors',
);

$this->menu=array(
	array('label'=>'Create Sector', 'url'=>array('create')),
	array('label'=>'Manage Sectors', 'url'=>array('admin')),
);
?>

<h1>Sectors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php 

echo '<hr>';
echo '<br>';
echo CHtml::button('Add New Goal', array('submit' => array('goal/create')));
echo CHtml::button('Edit Goals', array('submit' => array('goal/admin')));
echo '<hr>';
echo '<br>';
echo CHtml::button('Add New Target', array('submit' => array('target/create')));
echo CHtml::button('Edit Targets', array('submit' => array('target/admin')));
echo '<hr>';
echo '<br>';
echo CHtml::button('View Programmed Targets', array('submit' => array('pca/admin')));
echo '<hr>';
echo '<br>';

?>
