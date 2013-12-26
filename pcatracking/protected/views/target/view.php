<?php
/* @var $this TargetController */
/* @var $model Target */

$this->breadcrumbs=array(
	'Indicators'=>array('index'),
	$model->target_id,
);

$this->menu=array(
	//array('label'=>'List Indicator', 'url'=>array('index')),
	array('label'=>'Create Indicator', 'url'=>array('create')),
	array('label'=>'Update Indicator', 'url'=>array('update', 'id'=>$model->target_id)),
	array('label'=>'Delete Indicator', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->target_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Indicators', 'url'=>array('admin')),
);

if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Indicator <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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
 <div style="float:right;">
    <?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/excel37X35.png', array('submit' => array('target/generateExcel', 'id'=>$model->target_id)));  ?>
  </div>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>'striped bordered condensed',
	'attributes'=>array(
		//'target_id',
		array(
			'name'=>'sector',
			'value'=>$model->goal->sector->name,
		),
		array(
			'name'=>'goal',
			'value'=>$model->goal->name,
		),
		'name',
		// array(
		// 	'name'=>'rrp5_output_id',
		// 	'value'=>$model->rrp5output->name,
		// ),
		// array(
		//    'name'=>'assignedActivities',
		//    'type'=>'html',
		//    'value'=>$model->getRelatedActivities($model->TargetActivity,'name'),),
		array(
		   'name'=>'assignedUnits',
		   'type'=>'html',
		   'value'=>$model->getRelatedActivities($model->TargetProgressRel,'type', array('tpUnit')),),
		array(
		   'name'=>'assignedTotals',
		   'type'=>'html',
		   'value'=>$model->getRelatedActivities($model->TargetProgressRel,'total'),),
		// array(
		//    'name'=>'assignedPcas',
		//    'type'=>'html',
		//    'value'=>$model->getRelatedActivities($model->TargetProgressRel,'name', array('pcaTargetProgressRel', 'pca')),),
	),
));
?>

<h4>PCA Targets:</h4>
<table class='detail-view table table-striped table-bordered table-condensed'>
    <tr>
        <td><strong>Unit</strong></td><td><strong>Total Beneficiaries</strong></td><td><strong>Programmed</strong></td><td><strong>Current</strong></td><td><strong>Shortfall</strong></td>
    </tr>

<?php
$current_target =0;
foreach ($model->TargetProgressRel as $key => $value) {
    $criteria = new CDbCriteria;
    $criteria->select='SUM(current) as sum';
    $criteria->condition="target_progress_id=".$value['target_progress_id'];
    $current_target= PcaTargetProgress::model()->find($criteria);



    echo "<tr>";
    echo "<td>".$value->tpUnit->type."</td>";
    echo "<td>".$value['total']."</td>";
    echo "<td>".$value['current']."</td>";
    echo "<td>".$current_target->sum."</td>";
    echo "<td>".$value['shortfall']."</td>";
    echo "</tr>";

}

?>

</table>