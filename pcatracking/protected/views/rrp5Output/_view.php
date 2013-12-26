<?php
/* @var $this Rrp5OutputController */
/* @var $data Rrp5Output */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrp5_output_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rrp5_output_id), array('view', 'id'=>$data->rrp5_output_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sector_id')); ?>:</b>
	<?php echo CHtml::encode($data->sector->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>