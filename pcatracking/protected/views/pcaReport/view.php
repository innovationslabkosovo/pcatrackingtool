<?php
/* @var $this PcaReportController */
/* @var $model PcaReport */

$this->breadcrumbs=array(
	'PCA Reports'=>array('index'),
	$model->pca_report_id,
);

$this->menu=array(
	//array('label'=>'List PCA Reports', 'url'=>array('index')),
	array('label'=>'Create PCA Report', 'url'=>array('create')),
	//array('label'=>'Update PCA Report', 'url'=>array('update', 'id'=>$model->pca_report_id)),
	array('label'=>'Delete PCA Report', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pca_report_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PCA Reports', 'url'=>array('admin')),
);
?>

<h4><?php echo CHtml::link($model->pca->title, array('/pca/view', 'id'=>$model->pca->pca_id)); ?> Report <?php echo $model->title; ?> </h4>


<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'pca_report_id',
		//'pca_id',
		'start_period',
		'end_period',
		'received_date',
	),
)); 
?>
<h4>PCA Report Details:</h4>
<table class='detail-view table table-striped table-bordered table-condensed'>
<tr>
<td>Indicator</td><td>Total Beneficiaries</td><td>Type</td>
</tr>
<?php 

$strings = array();
$current_string = 0;

for ($i=0; $i < count($model->TargetProgressPcaReportRel); $i++) { 


	if ($model->TargetProgressPcaReportRel[$i]->PcaTargetProgress->tpTarget['target_id'] != $current_string){

		$current_string = $model->TargetProgressPcaReportRel[$i]->PcaTargetProgress->tpTarget['target_id'];
		$strings[$model->TargetProgressPcaReportRel[$i]->PcaTargetProgress->tpTarget['target_id']] = 1;
		

	} else {

		$current_string = $model->TargetProgressPcaReportRel[$i]->PcaTargetProgress->tpTarget['target_id'];
		$strings[$model->TargetProgressPcaReportRel[$i]->PcaTargetProgress->tpTarget['target_id']]++;
	}
    
}

$current_target = 0;
foreach ($model->TargetProgressPcaReportRel as $key => $value) {

	if ($value->PcaTargetProgress->tpTarget['target_id'] != $current_target){

		if (array_key_exists($value->PcaTargetProgress->tpTarget['target_id'], $strings) == 1){

		echo "<tr>";
    	echo "<td rowspan=".$strings[$value->PcaTargetProgress->tpTarget['target_id']]." width='50%'>".CHtml::link($value->PcaTargetProgress->tpTarget->tpTarget->name, array('/target/view', 'id'=>$value->PcaTargetProgress->tpTarget['target_id']))."</td>";
    	echo "<td>".$value['total']."</td>";
    	echo "<td>".$value->PcaTargetProgress->tpTarget->tpUnit->type."</td>";

		} 
	}
	else
	{
		echo "<td>".$value['total']."</td>";
    	echo "<td>".$value->PcaTargetProgress->tpTarget->tpUnit->type."</td>";
	}
	echo "</tr>";
	$current_target = $value->PcaTargetProgress->tpTarget['target_id'];
}

?>
</table>

<div id="existingFiles">

    <h4> Existing files</h4>

    <?php


    $files = array();

    $files = $model->PcaReportFile;


    foreach ((array)$files as $key => $value) {


        echo "<div id='fileDiv" . $value['pca_report_file_id'] . "'>";

        //	echo CHtml::link('x', 'javascript:void(0);', array( 'class'=>'deleteFile '.$value['file_name'], 'id'=>''.$value->pca_file_id));
        echo CHtml::ajaxLink("X", Yii::app()->createUrl('pcaReport/deleteFile', array('pca_report_id' => $model->pca_report_id)),
            array( // ajaxOptions
                'type' => 'POST',
                'beforeSend' => "function( request )
                                             {
                                                var r=confirm('Do you want to delete file: " . $value['file_name'] . " ');
                                                if (r==true)
                                                  {

                                                  }
                                                else
                                                  {
                                                    return false;
                                                  }
                                             }",
                'success' => "function( data )
                                          {
                                            // handle return data
                                            data = data.split(',');
                                            alert(data[0]);
                                            if (data[1] == 'true')
                                            $('#fileDiv'+" . $value['pca_report_file_id'] . ").remove();
                                          }",
                'data' => array('file_name' => $value['file_name'], 'file_id' => $value['pca_report_file_id'])
            ));

        echo " - ";
        echo CHtml::link($value->file_name, array('displayPcaReportFile', 'pca_report_id' => $model->pca_report_id, 'file_name' => $value['file_name']));
         echo "<br/>";
        echo "</div>";
        # code...
    }
    ?>

</div>