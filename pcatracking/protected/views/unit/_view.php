<?php
/* @var $this UnitController */
/* @var $data Unit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->unit_id), array('view', 'id'=>$data->unit_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />


</div>