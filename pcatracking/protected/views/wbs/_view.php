<?php
/* @var $this WbsController */
/* @var $data Wbs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('wbs_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->wbs_id), array('view', 'id'=>$data->wbs_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ir_id')); ?>:</b>
	<?php echo CHtml::encode($data->IntermediateResult->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>