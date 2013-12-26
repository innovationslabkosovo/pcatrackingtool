<?php
/* @var $this PcaReportController */
/* @var $data PcaReport */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pca_report_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pca_report_id), array('view', 'id'=>$data->pca_report_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pca_id')); ?>:</b>
	<?php echo CHtml::encode($data->pca_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_period')); ?>:</b>
	<?php echo CHtml::encode($data->start_period); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_period')); ?>:</b>
	<?php echo CHtml::encode($data->end_period); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('received_date')); ?>:</b>
	<?php echo CHtml::encode($data->received_date); ?>
	<br />


</div>