<?php
/* @var $this GatewayController */
/* @var $data Gateway */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('gateway_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->gateway_id), array('view', 'id'=>$data->gateway_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>