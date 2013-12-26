<?php
/* @var $this ContentTypeController */
/* @var $data ContentType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->content_id), array('view', 'id'=>$data->content_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />


</div>