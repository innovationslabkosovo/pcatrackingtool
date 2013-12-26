<?php
/* @var $this GoalController */
/* @var $model Goal */

$this->breadcrumbs=array(
	'CCCs'=>array('index'),
	$model->goal_id,
);

$this->menu=array(
	//array('label'=>'List CCC', 'url'=>array('index')),
	array('label'=>'Create CCC', 'url'=>array('create')),
	array('label'=>'Update CCC', 'url'=>array('update', 'id'=>$model->goal_id)),
	array('label'=>'Delete CCC', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->goal_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CCCs', 'url'=>array('admin')),
);

if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'C <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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
	'data'=>$model,
	'type'=>'striped bordered condensed',
	'attributes'=>array(
		//'goal_id',
		array(
		   'name'=>'sector',
		   'type'=>'html',
		   'value'=>$model->sector->name,),	
		'name',
		'description',
		
	),
)); ?>

<br>
<h4> This CCC is monitored with the following Indicators:</h4>
<table class='detail-view table table-striped table-bordered table-condensed'>

<tr>
<?php
foreach ($model->targets as $key => $value) {
	echo "<tr>";
	echo "<td>".CHtml::link($value['name'], array('/target/view', 'id'=>$value['target_id']))."</td>";	
	echo "</tr>";
}
?>
</tr>
</table>



<!-- <h4>This CCC is being achieved with the following PCAs:</h4>
<table class='detail-view table table-striped table-bordered table-condensed'>
<tr>
<td><strong>PCA</strong></td>
</tr>
<tr>

</tr>
</table> -->


