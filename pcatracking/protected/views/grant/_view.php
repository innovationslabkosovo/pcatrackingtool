<?php
/* @var $this GrantController */
/* @var $data Grant */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('grant_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->grant_id), array('view', 'id'=>$data->grant_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('donor_id')); ?>:</b>
	<?php echo CHtml::encode($data->donor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>