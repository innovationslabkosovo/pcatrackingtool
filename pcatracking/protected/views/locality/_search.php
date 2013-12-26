<?php
/* @var $this LocalityController */
/* @var $model Locality */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'locality_id'); ?>
		<?php echo $form->textField($model,'locality_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'region_id'); ?>
		<?php echo $form->textField($model,'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cad_code'); ?>
		<?php echo $form->textField($model,'cad_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cas_code'); ?>
		<?php echo $form->textField($model,'cas_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cas_code_un'); ?>
		<?php echo $form->textField($model,'cas_code_un'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cas_village_name'); ?>
		<?php echo $form->textField($model,'cas_village_name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->