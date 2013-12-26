<?php
/* @var $this GoalController */
/* @var $data Goal */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('goal_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->goal_id), array('view', 'id'=>$data->goal_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sector')); ?>:</b>
	<?php echo CHtml::encode($data->sector->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>