<?php
/* @var $this LocationController */
/* @var $model Location */
/* @var $form CActiveForm */

// if ($dialog_flag)
if ( isset($dialog_flag) )
{
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                    'id'=>"locationDialog_id$location_number",
                    'options'=>array(
                        'title'=>Yii::t('partner','Add Village'),
                        'autoOpen'=>true,
                        'modal'=>'true',
                        'width'=>'1000px',
                        'height'=>'auto',
                    ),
                    ));
}
?>


<div class="form">
<?php
/* @var $this LocationController */
/* @var $model Location */
/* @var $form CActiveForm */
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/assets/7e745f75/jquery.js');
//Yii::app()->clientScript->registerScriptFile('http://openlayers.org/dev/OpenLayers.js'); 
//Open Layers in loaded inside location.js
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/location/location.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/location/create.js');
?>

<?php 
	
	if ($model->location_id == NULL)
	{
		$governorate_id = -1;
		$region_id = -1;
		$locality_id = -1;
	}else
	{
		$governorate_id = $model->locality->region->governorate_id;
		$region_id = $model->locality->region_id;
		$locality_id = $model->locality_id ;
		
	}

 ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'location-form',
	'enableAjaxValidation'=>false,
	 'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
)); ?>
	<?php echo CHtml::hiddenField('dialog_flag', isset($dialog_flag) ); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php echo $form->labelEx($model,'Select Governorate'); ?>
	<?php  echo CHtml::dropDownList('governorate_id','',CHtml::listData(Governorate::model()->findAll("1 ORDER BY name"),'governorate_id','name'),array(
												'prompt'=>'Select Governorate',
												'class'=>'governorate',		
												// 'options' => array($model->locality->region->governorate_id =>array('selected'=>true))										
												'options' => array($governorate_id =>array('selected'=>true))										
											)); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'Select Kadaa'); ?>
	<?php echo CHtml::dropDownList('region_id','',CHtml::listData(Region::model()->findAll("governorate_id=$governorate_id"." ORDER BY name") ,'region_id','name'),array(
				'prompt'=>'Select Kadaa',
				'class'=>'region',
				// 'options' => array($model->locality->region_id =>array('selected'=>true)),
				'options' => array($region_id =>array('selected'=>true)),
				)); 
	?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'Select Locality'); ?>
	<?php echo $form->dropDownList($model,'locality_id',CHtml::listData(Locality::model()->findAll("region_id=$region_id"." ORDER BY name"),'locality_id','name'),array(
				'prompt'=>'Select Locality',
				'class'=>'locality',
				'id'=>'locality_id',
				'options' => array($model->locality_id =>array('selected'=>true))
				)); 
	?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'p_code'); ?>
		<?php echo $form->textField($model,'p_code'); ?>
		<?php echo $form->error($model,'p_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude',array('id'=>'latitude','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model,'longitude',array('id'=>'longitude','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>
  <div id="map" style="width:800px; height:600px"></div>
  <br>
	<div class="row buttons">
		<?php
		// if ($dialog_flag) 
		if ( isset($dialog_flag) ) 
		{

		echo CHtml::ajaxSubmitButton('Add Village',CHtml::normalizeUrl(array('location/create','render'=>false)),array(
			'beforeSend'=>'js: function(){$("body").undelegate("#closeLocationDialog","click");}',
			'success'=>'js: function(data) {
			            $("#location_id'.$location_number.'").append(data);                                                      
                        $("#locationDialog_id'.$location_number.'").dialog("close");

                    }'),array('id'=>'closeLocationDialog')); 
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



