<?php
/* @var $this AuthGroupController */
/* @var $data AuthGroup */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->group_id), array('view', 'id'=>$data->group_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>