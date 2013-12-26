<?php
/* @var $this ActivityController */
/* @var $model Activity */

$this->breadcrumbs=array(
	'Activities'=>array('index'),
	$model->name,
);


$this->menu=array(
	//array('label'=>'List Activity', 'url'=>array('index')),
	array('label'=>'Create Activity', 'url'=>array('create')),
	array('label'=>'Update Activity', 'url'=>array('update', 'id'=>$model->activity_id)),
	array('label'=>'Delete Activity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->activity_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Activities', 'url'=>array('admin')),
);


// display error message if deletion failed.
if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Activity <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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

<h1>Activity: <?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
		   'name'=>'sector',
		   'type'=>'html',
		   'value'=>$model->sector->name),
		'name',
		
	),
)); ?>
