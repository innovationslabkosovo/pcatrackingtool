<?php
/* @var $this WbsController */
/* @var $model Wbs */
/* @var $form CActiveForm */
$sector_id = "sector_id = 99";
// if ($model->IntermediateResult->sector_id != NULL) $sector_id = 'sector_id = '.$model->IntermediateResult->sector_id;
if (isset($model->IntermediateResult->sector_id)) $sector_id = 'sector_id = '.$model->IntermediateResult->sector_id;
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'wbs-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div>
		<?php  echo $form->labelEx($model,'Select Sector'); ?>
		<?php  echo CHtml::dropDownList('sector_id','',CHtml::listData(Sector::model()->findAll(),'sector_id','name'),array(
									'ajax' => array(
									'type'=>'POST', //request type
									'url'=>$this->createUrl('pca/returnparent'), //url to call.
									//Style: CController::createUrl('currentController/methodToCall')
									'update'=>'#Wbs_ir_id', //selector to update
									 'data'=>array('fk_val'=>'js:$(\'#sector_id\').val()','current_model'=>'intermediateResult','pk'=>'ir_id','name'=>'name','fk_name'=>'sector_id'),
									//  'success'=> "function(data) {
									//  							data = data.split('nextitem;');
									//  							$('#Target_goal_id').html(data[0]);
									//  							$('#Target_rrp5_output_id').html(data[1]);
									//  						}"
									//leave out the data key to pass all form values through
									),
									'prompt'=>'Select Sector',
									// 'options' => array($model->IntermediateResult->sector_id=>array('selected'=>true))
									'options' => array($sector_id=>array('selected'=>true))
								) 
		 ); ?>

	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ir_id'); ?>
	<?php echo $form->dropDownList($model,'ir_id',CHtml::listData(IntermediateResult::model()->findAll($sector_id),'ir_id','name'),array('prompt'=>'Select IntermediateResult')); ?>
			<?php echo $form->error($model,'ir_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
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