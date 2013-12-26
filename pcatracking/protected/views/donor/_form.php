<?php
/* @var $this DonorController */
/* @var $model Donor */
/* @var $form CActiveForm */

// if ($dialog_flag)
if ( isset($dialog_flag) )
{
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                    'id'=>"donorDialog_id$donor_number",
                    'options'=>array(
                        'title'=>Yii::t('partner','Add Donor'),
                        'autoOpen'=>true,
                        'modal'=>'true',
                        'width'=>'1000px',
                        'height'=>'auto',
                    ),
                    ));
}
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'donor-form',
	 'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php //echo CHtml::hiddenField('dialog_flag',$dialog_flag); ?>
	<?php echo CHtml::hiddenField('dialog_flag', isset($dialog_flag) ); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php
		if ( isset($dialog_flag) ) 
		{

		echo CHtml::ajaxSubmitButton('Add Donor',CHtml::normalizeUrl(array('donor/create','render'=>false)),array(
			'beforeSend'=>'js: function(){$("body").undelegate("#closeDonorDialog","click");}',
			'success'=>'js: function(data) {
                        $("#donor_id'.$donor_number.'").append(data);                                                      
                        $("#donorDialog_id'.$donor_number.'").dialog("close");

                    }'),array('id'=>'closeDonorDialog')); 
		}else
		{
			$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'id'=>'submit', 
				'label'=>$model->isNewRecord ? 'Create' : 'Save',
				'type'=>'primary'
				)); 
		}
		
		?>
	</div>

<?php $this->endWidget(); ?>

<?php if ( isset($dialog_flag) ) $this->endWidget('zii.widgets.jui.CJuiDialog');?>

</div><!-- form -->