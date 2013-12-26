<?php
/* @var $this AuthPermissionController */
/* @var $data AuthPermission */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('permission_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->permission_id), array('view', 'id'=>$data->permission_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_id')); ?>:</b>
	<?php echo CHtml::encode($data->content_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>