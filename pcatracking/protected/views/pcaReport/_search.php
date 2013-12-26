<?php
/* @var $this PcaReportController */
/* @var $model PcaReport */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pca_report_id'); ?>
		<?php echo $form->textField($model,'pca_report_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pca_id'); ?>
		<?php echo $form->textField($model,'pca_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_period'); ?>
		<?php echo $form->textField($model,'start_period'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_period'); ?>
		<?php echo $form->textField($model,'end_period'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'received_date'); ?>
		<?php echo $form->textField($model,'received_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->