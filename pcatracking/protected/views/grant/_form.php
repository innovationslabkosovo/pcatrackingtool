<?php
/* @var $this GrantController */
/* @var $model Grant */
/* @var $form CActiveForm */

// if ($dialog_flag)
if ( isset($dialog_flag) )
{
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                    'id'=>"grantDialog_id$grant_number",
                    'options'=>array(
                        'title'=>Yii::t('partner','Add Grant'),
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
	'id'=>'grant-form',
	 'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo CHtml::hiddenField('dialog_flag',$dialog_flag); ?>
		<?php echo CHtml::hiddenField('dialog_flag', isset( $dialog_flag) ); ?>

		<?php //echo $form->labelEx($model,'grant_id'); ?>
		<?php //echo $form->textField($model,'grant_id'); ?>
		<?php //echo $form->error($model,'grant_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'donor_id'); ?>
		<?php echo $form->dropDownList($model,'donor_id',CHtml::listData(Donor::model()->findAll(array('order'=>'name ASC')),'donor_id','name'),array('prompt'=>'Select Donor')); ?>
		 <?php
		 // if (!$dialog_flag) 
		 if ( !isset($dialog_flag) ) 
			{

			 		$this->widget('bootstrap.widgets.TbButton', array(
						'buttonType'=>'ajaxLink',
						'id'=>'showDonorDialog',
						'label'=>'Create a new Donor',
						'type'=>'info',
						'size'=>'mini',
						'url' => $this->createURL('Donor/create'),
						'ajaxOptions' => array(
								        'onclick'=>'$("#donorDialog").dialog("open"); return false;',
								        'update'=>'#donorDialog',    
								        ),    
			      
					));
			}
				?>

       <div id="donorDialog"></div>
		<?php echo $form->error($model,'donor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php
		// if ($dialog_flag) 
		if ( isset($dialog_flag) ) 
		{

		echo CHtml::ajaxSubmitButton('Add Grant',CHtml::normalizeUrl(array('grant/create','render'=>false)),array(
			'beforeSend'=>'js: function(){$("body").undelegate("#closeGrantDialog","click");}',
			'success'=>'js: function(data) {
                        $("#grant_id'.$grant_number.'").append(data);                                                      
                        $("#grantDialog_id'.$grant_number.'").dialog("close");

                    }'),array('id'=>'closeGrantDialog')); 
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


<?php //if ($dialog_flag) $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<?php if ( isset($dialog_flag) ) $this->endWidget('zii.widgets.jui.CJuiDialog');?>


</div><!-- form -->