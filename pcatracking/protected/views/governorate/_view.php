<?php
/* @var $this GovernorateController */
/* @var $data Governorate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('governorate_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->governorate_id), array('view', 'id'=>$data->governorate_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>