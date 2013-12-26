<?php
/* @var $this Rrp5OutputController */
/* @var $model Rrp5Output */

$this->breadcrumbs=array(
	'RRP Outputs'=>array('index'),
	$model->rrp5_output_id,
);

$this->menu=array(
	//array('label'=>'List Rrp5Output', 'url'=>array('index')),
	array('label'=>'Create RRP Output', 'url'=>array('create')),
	array('label'=>'Update RRP Output', 'url'=>array('update', 'id'=>$model->rrp5_output_id)),
	array('label'=>'Delete RRP Output', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rrp5_output_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RRP Outputs', 'url'=>array('admin')),
);
if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'RRP Output <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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

<h4><?php echo $model->name; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'rrp5_output_id',
		array(
		   'name'=>'sector',
		   'type'=>'html',
		   'value'=>$model->sector->name,),	
		'name',
	),
)); ?>
