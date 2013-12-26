<?php
/* @var $this LocalityController */
/* @var $model Locality */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/locality/create.js');
?>
<?php

	if ($model->locality_id == NULL)
	{
		$governorate_id = -1;
		$region_id = -1;
		
	}else
	{
		$governorate_id = $model->region->governorate_id;
		$region_id = $model->region_id;			
	}

?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'locality-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php echo $form->labelEx($model,'Select Governorate'); ?>
	<?php  echo CHtml::dropDownList('governorate_id','',CHtml::listData(Governorate::model()->findAll("1 ORDER BY name"),'governorate_id','name'),array(
												'prompt'=>'Select Governorate',
												'class'=>'governorate',	
												'options' => array($governorate_id =>array('selected'=>true))										
																			
											)); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'Select Kadaa'); ?>
	<?php echo $form->dropDownList($model,'region_id',CHtml::listData(Region::model()->findAll("governorate_id=$governorate_id"." ORDER BY name"),'region_id','name'),array(
				'prompt'=>'Select Kadaa',
				'class'=>'region',
				'id' => 'region_id',
				'options' => array($region_id =>array('selected'=>true))										
								
				)); 
	?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cas_village_name'); ?>
		<?php echo $form->textArea($model,'cas_village_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'cas_village_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cad_code'); ?>
		<?php echo $form->textField($model,'cad_code'); ?>
		<?php echo $form->error($model,'cad_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cas_code'); ?>
		<?php echo $form->textField($model,'cas_code'); ?>
		<?php echo $form->error($model,'cas_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cas_code_un'); ?>
		<?php echo $form->textField($model,'cas_code_un'); ?>
		<?php echo $form->error($model,'cas_code_un'); ?>
	</div>

	<div class="row buttons">
		<?php 			
				$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'id'=>'submit', 
				'label'=>$model->isNewRecord ? 'Create' : 'Save',
				'type'=>'primary'
				));  ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->