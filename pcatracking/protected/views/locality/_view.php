<?php
/* @var $this LocalityController */
/* @var $data Locality */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('locality_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->locality_id), array('view', 'id'=>$data->locality_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region')); ?>:</b>
	<?php echo CHtml::encode($data->->region->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cas_village_name')); ?>:</b>
	<?php echo CHtml::encode($data->cas_village_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cad_code')); ?>:</b>
	<?php echo CHtml::encode($data->cad_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cas_code')); ?>:</b>
	<?php echo CHtml::encode($data->cas_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cas_code_un')); ?>:</b>
	<?php echo CHtml::encode($data->cas_code_un); ?>
	<br />

</div>