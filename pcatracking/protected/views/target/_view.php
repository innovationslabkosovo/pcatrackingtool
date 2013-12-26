<?php
/* @var $this TargetController */
/* @var $data Target */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('target_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->target_id), array('view', 'id'=>$data->target_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goal_id')); ?>:</b>
	<?php echo $data->goal->name; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('rrp5_output_id')); ?></b>
	<?php// echo $data->rrp5output->name; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assignedActivities')); ?>:</b>
	<?php echo $data->getRelatedActivities($data->TargetActivity,'name'); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('assignedUnits')); ?>:</b>
	<?php echo  $data->getRelatedActivities($data->TargetProgressRel,'type', array('tpUnit')); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('assignedTotals')); ?>:</b>
	<?php echo $data->getRelatedActivities($data->TargetProgressRel,'total'); ?>
	<br />

	


</div>