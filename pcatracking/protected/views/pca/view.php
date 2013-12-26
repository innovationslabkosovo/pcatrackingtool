<?php
Yii::import('application.modules.user.models.YumUser');
/* @var $this PcaController */
/* @var $model Pca */


$this->breadcrumbs=array(
	'PCAs'=>array('index'),
	$model->pca_id,
);

$this->menu=array(
	//array('label'=>'List Pca', 'url'=>array('index')),
	array('label'=>'Create PCA', 'url'=>array('create')),
	array('label'=>'Update PCA', 'url'=>array('update', 'id'=>$model->pca_id)),
	array('label'=>'Delete PCA', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pca_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PCAs', 'url'=>array('admin')),
);

// display error message if deletion failed.
if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'PCA <strong>'.$model->title.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
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

<h4>
<?php 
if($model->number != null) { 
	echo $model->number; 
	echo ": "; 
	echo $model->title; 
} else {
	echo $model->title; 
}
?>

 </h4>

  <div style="float:right;">
    <?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/excel37X35.png', array('submit' => array('pca/generateExcel', 'id'=>$model->pca_id)));  ?>
  </div>

<?php

//echo $model->getRelatedActivities($model->PcaTargetProgressRel,'unit_id');
 $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>'striped bordered condensed',
	'attributes'=>array(
		//'pca_id',
		'number',
		'status',
		array(
		   'name'=>'PcaSector',
		   'type'=>'html',
		   'value'=>$model->getRelatedActivities($model->PcaSector,'name') ,),
/*		array(
		   'name'=>'ccc',
		   'type'=>'html',
		   'value'=>$model->getRelatedActivities($model->PcaTargetProgressRel,'name', array('tpTarget', 'tpTarget', 'goal')) ,),*/
		'start_date',
		'end_date',
		'initiation_date',
		'unicef_mng_first_name',
		'unicef_mng_last_name',
		'unicef_mng_email',
		array(
		   'name'=>'partner',
		   'type'=>'html',
		   'value'=>$model->partner->name,),
		'partner_mng_first_name',
		'partner_mng_last_name',
		'partner_mng_email',
		'unicef_cash_budget',
		'partner_contribution_budget',
		'total_cash',
		array(
		   'name'=>'PcaGrantRel',
		   'type'=>'html',
		   'value'=> $model->getRelatedActivities($model->PcaGrantRel,'name', array('grant'))),
		array(
		   'name'=>'assignedActivities',
		   'type'=>'html',
		   'value'=>$model->getRelatedActivities($model->PcaActivity,'name') ,),
		array(
		   'name'=>'assignedRRPs',
		   'type'=>'html',
		   'value'=>$model->getRelatedActivities($model->PcaRrp5Output,'name') ,),
		array(
            'name'=>'PcaWbs',
			'type'=>'raw',
             'value'=>$model->getRelatedActivities($model->PcaWbs, 'name' )),
))); ?>

<h4>PCA Targets:</h4>
<table class='detail-view table table-striped table-bordered table-condensed'>
<tr>
<td><strong>Indicator</strong></td><td><strong>Total Beneficiaries</strong></td><td><strong>Current</strong></td><td><strong>Shortfall</strong></td><td><strong>Type</strong></td>
</tr>

<?php 

$strings = array();
$current_string = 0;

for ($i=0; $i < count($model->PcaTargetProgressRel); $i++) { 


	if ($model->PcaTargetProgressRel[$i]->tpTarget['target_id'] != $current_string){

		$current_string = $model->PcaTargetProgressRel[$i]->tpTarget['target_id'];
		$strings[$model->PcaTargetProgressRel[$i]->tpTarget['target_id']] = 1;
		

	} else {

		$current_string = $model->PcaTargetProgressRel[$i]->tpTarget['target_id'];
		$strings[$model->PcaTargetProgressRel[$i]->tpTarget['target_id']]++;
	}
    
}

$current_target = 0;
foreach ($model->PcaTargetProgressRel as $key => $value) {

	if ($value->tpTarget['target_id'] != $current_target){

		if (array_key_exists($value->tpTarget['target_id'], $strings) == 1){

		echo "<tr>";
    	echo "<td rowspan=".$strings[$value->tpTarget['target_id']]." width='50%'>".CHtml::link($value->tpTarget->tpTarget->name, array('/target/view', 'id'=>$value->tpTarget['target_id']))."</td>";
    	echo "<td>".$value['total']."</td>";
    	echo "<td>".$value['current']."</td>";
    	echo "<td>".$value['shortfall']."</td>";
    	echo "<td>".$value->tpTarget->tpUnit->type."</td>";		

		} 
	}
	else
	{
		echo "<td>".$value['total']."</td>";
		echo "<td>".$value['current']."</td>";
    	echo "<td>".$value['shortfall']."</td>";
    	echo "<td>".$value->tpTarget->tpUnit->type."</td>";		
	}
	echo "</tr>";
	$current_target = $value->tpTarget['target_id'];
}

?>
</table>

<h4>PCA Villages and Gateways</h4>
<table class='detail-view table table-striped table-bordered table-condensed'>
<tr>
<td><strong>Village</strong></td><td><strong>Gateway</strong></td>
</tr>
<?php 

$strings = array();
$current_string = 0;

for ($i=0; $i < count($model->GwPcaLocRel); $i++) { 


	if ($model->GwPcaLocRel[$i]['location_id'] != $current_string){

		$current_string = $model->GwPcaLocRel[$i]['location_id'];
		$strings[$model->GwPcaLocRel[$i]['location_id']] = 1;
		

	} else {

		$current_string = $model->GwPcaLocRel[$i]['location_id'];
		$strings[$model->GwPcaLocRel[$i]['location_id']]++;		 
	}
    
}

$current_target = 0;
foreach ((array)$model->GwPcaLocRel as $key => $value) {

	if ($value['location_id'] != $current_target){

		if (array_key_exists($value['location_id'], $strings) == 1){

		echo "<tr>";
    	echo "<td rowspan=".$strings[$value['location_id']]." width='50%'>".CHtml::link($value->Location->name, array('/location/view', 'id'=>$value['location_id']))."</td>";
    	echo "<td>".$value->Gateway->name."</td>";		

		} 
	}
	else
	{
    	echo "<td>".$value->Gateway->name."</td>";		
	}
	echo "</tr>";
	$current_target = $value['location_id'];
}

?>
</table>

<div id="existingFiles">
		  	<h4> PCA Files</h4>

			  <?php
              $files = $model->PcaFile;
              foreach ((array)$files  as $key => $value) {

                  echo "<div id='fileDiv".$value['pca_file_id']."'>";
                  if ($key == 0)
                      echo "<h6>".$model->pca_file_categories[$value['file_category']]."</h6>";
                  else if($value['file_category'] != $model->PcaFile[$key-1]['file_category'] )
                      echo "<h6>".$model->pca_file_categories[$value['file_category']]."</h6>";
                  echo CHtml::link($value->file_name,array('displaySavedFile','file_category' => $value['file_category'],'pca_id' => $model->pca_id, 'file_name' => $value['file_name']));
                  echo "<br/>";
                  echo "</div>";
                  # code...
              }
		?>
		<br>
</div>

<div id="pca_change_log">
    <h4> PCA Change Log</h4>
    <table class='detail-view table table-striped table-bordered table-condensed'>
        <thead>
        <tr>
            <td>Username</td>
            <td>Action</td>
            <td>Date and Time</td>
        </tr>
        </thead>
    <?php foreach ((array)$model->PcaUserActionRel as $key => $value) {

        $user= YumUser::model()->find($value['user_id']);

        echo "<tr>";
        echo "<td>".$user->username."</td>";
        echo "<td>".$value['action']."</td>";
        echo "<td>".$value['datetime']."</td>";
        echo "</tr>";


        # code...
    }
    ?>
    </table>
    <br>
</div>