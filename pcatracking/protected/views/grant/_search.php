<?php
/* @var $this GrantController */
/* @var $model Grant */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php //echo $form->label($model,'grant_id'); ?>
		<?php //echo $form->textField($model,'grant_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'donor_id'); ?>
		<?php echo $form->textField($model,'donor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->