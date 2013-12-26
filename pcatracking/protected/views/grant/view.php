<?php
/* @var $this GrantController */
/* @var $model Grant */

$this->breadcrumbs=array(
	'Grants'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Grant', 'url'=>array('index')),
	array('label'=>'Create Grant', 'url'=>array('create')),
	array('label'=>'Update Grant', 'url'=>array('update', 'id'=>$model->grant_id)),
	array('label'=>'Delete Grant', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->grant_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Grants', 'url'=>array('admin')),
);


if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Grant <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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

<h4>Grant <?php echo $model->name; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'grant_id',
		'name',
		array(
		   'name'=>'donor',
		   'type'=>'html',
		   'value'=>$model->donor->name,),	
	),
)); ?>
