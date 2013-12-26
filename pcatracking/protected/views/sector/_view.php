<?php
/* @var $this SectorController */
/* @var $data Sector */
?>

<div class="view">

	<b><?php //echo CHtml::encode($data->getAttributeLabel('sector_id')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->sector_id), array('view', 'id'=>$data->sector_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>