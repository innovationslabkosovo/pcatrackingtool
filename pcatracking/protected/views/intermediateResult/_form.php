<?php
/* @var $this IntermediateResultController */
/* @var $model IntermediateResult */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'intermediate-result-form',
	'enableAjaxValidation'=>false,
	 'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sector_id'); ?>
		<?php echo $form->dropDownList($model,'sector_id',CHtml::listData(Sector::model()->findAll(),'sector_id','name'),array('prompt'=>'Select Sector')); ?>
		<?php echo $form->error($model,'sector_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ir_wbs_reference'); ?>
		<?php echo $form->textField($model,'ir_wbs_reference',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ir_wbs_reference'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php  $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'id'=>'submit', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			'type'=>'primary'
			));
		 ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->