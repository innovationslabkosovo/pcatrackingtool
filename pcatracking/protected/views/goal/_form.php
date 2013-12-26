<?php
/* @var $this GoalController */
/* @var $model Goal */
/* @var $form CActiveForm */

//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/goal/create.js');
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'goal-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sector_id'); ?>
		<?php  echo $form->dropDownList($model,'sector_id',CHtml::listData(Sector::model()->findAll(),'sector_id','name'),array('empty'=>"Select Sector")); ?>
		<?php echo $form->error($model,'sector_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'description'); ?>
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