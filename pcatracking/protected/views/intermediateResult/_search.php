<?php
/* @var $this IntermediateResultController */
/* @var $model IntermediateResult */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ir_id'); ?>
		<?php echo $form->textField($model,'ir_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sector_id'); ?>
		<?php echo $form->textField($model,'sector_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ir_wbs_reference'); ?>
		<?php echo $form->textField($model,'ir_wbs_reference',array('size'=>50,'maxlength'=>50)); ?>
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