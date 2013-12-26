<?php
/* @var $this WbsController */
/* @var $model Wbs */

$this->breadcrumbs=array(
	'WBS/Activity'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Wbs', 'url'=>array('index')),
	array('label'=>'Create WBS/Activity', 'url'=>array('create')),
	array('label'=>'Update WBS/Activity', 'url'=>array('update', 'id'=>$model->wbs_id)),
	array('label'=>'Delete WBS/Activity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->wbs_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WBS/Activity', 'url'=>array('admin')),
);


if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Donor <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
	 $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); 
	
}

?>

<h4>WBS <?php echo $model->name; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
	//	'wbs_id',
		array(
		'name'=>'sector',
		'value'=>$model->IntermediateResult->sector->name,
		),
		array(
		'name'=>'ir_id',
		'value'=>$model->IntermediateResult->name,
		),
		'name',
	),
)); ?>
