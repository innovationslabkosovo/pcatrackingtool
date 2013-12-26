<?php
/* @var $this RegionController */
/* @var $data Region */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('region_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->region_id), array('view', 'id'=>$data->region_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>