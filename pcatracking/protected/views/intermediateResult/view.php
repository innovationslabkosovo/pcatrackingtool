<?php
/* @var $this IntermediateResultController */
/* @var $model IntermediateResult */

$this->breadcrumbs=array(
	'Intermediate Results'=>array('index'),
	$model->ir_id,
);

$this->menu=array(
//	array('label'=>'List IntermediateResult', 'url'=>array('index')),
	array('label'=>'Create Intermediate Result', 'url'=>array('create')),
	array('label'=>'Update Intermediate Result', 'url'=>array('update', 'id'=>$model->ir_id)),
	array('label'=>'Delete Intermediate Result', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ir_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Intermediate Results', 'url'=>array('admin')),
);


if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Intermediate Result <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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

<h4>IR: <?php echo $model->name; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'ir_id',
		array(
		'name'=>'sector_id',
		'value'=>$model->sector->name,
		),
		'ir_wbs_reference',
		'name',
	),
)); ?>
