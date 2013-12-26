<?php
/* @var $this DonorController */
/* @var $data Donor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('donor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->donor_id), array('view', 'id'=>$data->donor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>