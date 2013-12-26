
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'permission-create-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<label> <?php echo Yum::t('Do you want to grant this permission to a user or a role'); ?> </label>
	<?php echo $form->radioButtonList($model, 'type', array(
				'user' => Yum::t('User'),
				'role' => Yum::t('Role')),
			array('template' => '<div class="checkbox">{input}</div>{label}'
				)); ?>
			<?php echo $form->error($model,'type'); ?>
	</div>

	<div id="assignment_user">
	<div class="row">
	<?php echo $form->labelEx($model,'principal_id'); ?>
	<?php $this->widget('Relation', array(
				'model' => $model,
				'relation' => 'principal',				
				'fields' => 'username',
				));?>
		<?php echo $form->error($model,'principal_id'); ?>

		<?php echo $form->labelEx($model,'subordinate_id'); ?>
		<?php $this->widget('Relation', array(
					'model' => $model,
					'allowEmpty' => true,
					'relation' => 'subordinate',
					'fields' => 'username',
					));?>

		<?php echo $form->error($model,'subordinate_id'); ?>
		</div>
	<div class="row">
		<?php echo $form->labelEx($model,'template'); ?>
		<?php echo $form->dropDownList($model,'template', array(
					'0' => Yum::t('No'),
					'1' => Yum::t('Yes'),
					)); ?>
		<?php echo $form->error($model,'template'); ?>
	</div>

		</div>

	<div id="assignment_role" style="display: none;">
	<div class="row">
	<?php echo $form->labelEx($model,'principal_id'); ?>
	<?php $this->widget('Relation', array(
				'model' => $model,
				'relation' => 'principal_role',
				'htmlOptions' => array('disabled'=>true),
				'fields' => 'title',						
				));?>
		<?php echo $form->error($model,'principal_id'); ?>

		<?php echo $form->labelEx($model,'subordinate_id'); ?>
		<?php $this->widget('Relation', array(
					'model' => $model,
					'allowEmpty' => true,
					'relation' => 'subordinate_role',
					'fields' => 'title',								
				));?>

		<?php echo $form->error($model,'subordinate_id'); ?>
		</div>
		</div>



	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->dropDownList($model,'action',array(),array('multiple'=>true,'readonly'=>true, 'style' => 'width:220px;height:250px;'));  ?>
	 	
		<?php /*$this->widget('Relation', array(
					'model' => $model,
					'relation' => 'Action',
					'htmlOptions' => array(
						'multiple' => true,
						'style' => 'width:220px;height:250px;',
						array_merge('disabled' => true,array( 'user_update')),
						),
					'fields' => 'title',

					));?>
		<?php echo $form->error($model,'action'); */?> 
		<p>*Assigned Actions for selected principal are not displayed</p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment'); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php


Yii::app()->clientScript->registerScript('type', "

$(document).ready(function(){
console.log($('#YumPermission_principal_id').val())	;

$('#YumPermission_type_0').click(function() {
$('#assignment_role').hide();
$('#assignment_user').show();
$('#assignment_role #YumPermission_principal_id').attr('disabled',true);
$('#assignment_user #YumPermission_principal_id').attr('disabled',false);

});

$('#YumPermission_type_1').click(function() {
$('#assignment_role').show();
$('#assignment_user').hide();
$('#assignment_role #YumPermission_principal_id').attr('disabled',false);
$('#assignment_user #YumPermission_principal_id').attr('disabled',true);
});

$('#YumPermission_principal_id, #YumPermission_role_id').on('change', function(){
	var principal_id = $(this).val();
	var user_type = $('input:radio:checked').val();
	$.fn.myFunction(principal_id,user_type);
});
 $.fn.myFunction = function(principal_id, user_type) { 
   jQuery.ajax({
			'type':'POST',
			'url':'disableAssigendActions',
			'data':{'principal_id':principal_id, 'user_type':user_type},
			'cache':false,
			'success':function(data){jQuery($('#YumPermission_action').html(data));}});
		return false;

 }

$('#YumPermission_principal_id').trigger($.fn.myFunction($('#YumPermission_principal_id').val(),$('input:radio:checked').val()));



}); 

");
