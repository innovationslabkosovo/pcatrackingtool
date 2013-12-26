<?php
/* @var $this ActivityController */
/* @var $data Activity */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('activity_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->activity_id), array('view', 'id'=>$data->activity_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assignedTargets')); ?>:</b>
	<?php echo $data->getRelatedActivities($data->TargetActivity,'name'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assignedPcas')); ?>:</b>
	<?php echo $data->getRelatedActivities($data->PcaActivity,'number'); ?>
	<br />


</div>