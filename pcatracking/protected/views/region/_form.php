<?php
/* @var $this RegionController */
/* @var $model Region */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'region-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'governorate_id'); ?>
		<?php  echo $form->dropDownList($model,'governorate_id',CHtml::listData(Governorate::model()->findAll(),'governorate_id','name')); ?>
		<?php echo $form->error($model,'governorate_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'region_id'); ?>
		<?php //echo $form->textField($model,'region_id'); ?>
		<?php //echo $form->error($model,'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'id'=>'submit', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			'type'=>'primary'
			));?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->