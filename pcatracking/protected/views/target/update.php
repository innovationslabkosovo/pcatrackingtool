<?php
/* @var $this IndicatorController */
/* @var $model Indicator */

$this->breadcrumbs=array(
	'Indicators'=>array('index'),
	$model->target_id=>array('view','id'=>$model->target_id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List Indicator', 'url'=>array('index')),
	array('label'=>'Create Indicator', 'url'=>array('create')),
	array('label'=>'View Indicator', 'url'=>array('view', 'id'=>$model->target_id)),
	array('label'=>'Manage Indicators', 'url'=>array('admin')),
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<h4>Update <?php echo $model->name; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>