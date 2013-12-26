<?php
/* @var $this PartnerOrganizationController */
/* @var $model PartnerOrganization */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/partnerOrganization/create.js');

if ($dialog_flag)
{
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                    'id'=>'partnerDialog',
                    'options'=>array(
                        'title'=>Yii::t('partner','Add Partner'),
                        'autoOpen'=>true,
                        'modal'=>'true',
                        'width'=>'1000px',
                        'height'=>'auto',
                    ),
                    ));
}
?>



<div class="form" id="partnerDialogForm">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'partner-organization-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo CHtml::hiddenField('dialog_flag',$dialog_flag); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_person'); ?>
		<?php echo $form->textField($model,'contact_person'); ?>
		<?php echo $form->error($model,'contact_person'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textField($model,'phone_number'); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>
 	<!-- fieldset class="PO-activities">
	 	<legend>Partner Organization Activities:</legend>
	<div class="row"> -->
		
		<?php //$model->tblActivities = array_keys(CHtml::listData($model->tblActivities, 'activity_id' , 'activity_id'));
			  //echo $form->checkBoxList($model,'tblActivities',CHtml::listData(Activity::model()->findAll(),'activity_id','name')); ?>

		  <?php //echo CHtml::ajaxLink('Add Acitvity',$this->createUrl('Activity/create'),array(
        // 'onclick'=>'$("#activityDialog").dialog("open"); retrun false;',
        // 'update'=>'#activityDialog',        
        // ),array('id'=>'showActivityDialog'));?>
     <!--    <div id="activityDialog"></div>  

        
	</div>
	</fieldset>  -->

	<fieldset class="PO-locations">
	 	<legend>Villages where this NGO works:</legend>

	 		<?php

			 		// if ($donor_id == null) $donor_id = -1;

			 	$po_locations = $model->tblLocations;

	 			for($j=0; $j<sizeof($po_locations)+1;$j++) {			
	 				
	 				$location_number = $j + 1;

	 				if ($po_locations[$j]['location_id'] == NULL && $j==0){

			 				$governorate_id = -1;
			 				$region_id = -1;
			 				$locality_id = -1;
			 				$location_id = 0;

				 		}elseif ($po_locations[$j]['location_id'] == NULL && $j==sizeof($po_locations))	{			 		
				 		continue;
				 		}else{

							$governorate_id = $po_locations[$j]->locality->region['governorate_id'];
	 						$region_id = $po_locations[$j]->locality['region_id'];
	 						$locality_id = $po_locations[$j]['locality_id'];
	 						$location_id = $po_locations[$j]['location_id'];
				 			

				 		}

	 				 
	 				# code...
	 			

	 		 ?>
				<div class="poLocationDiv" id='poLocationDiv<?php echo $location_number; ?>'>
					<h5>Village <span id="locationNumber"><?php echo $location_number; ?></span></h5>
					<div class="row inline">
					<?php echo $form->labelEx($model,'Select Governorate'); ?>
					<?php  echo CHtml::dropDownList('po_governorate_id'.$location_number,'',CHtml::listData(Governorate::model()->findAll("1 ORDER BY t.name"),'governorate_id','name'),array(
												'prompt'=>'Select Governorate',
												'class'=>'governorate',
												'options' => array($governorate_id=>array('selected'=>true)),
												
											) 
					 ); ?>
					 </div>
			  		<div class="row inline">
						<?php echo $form->labelEx($model,'Select Kadaa'); ?>
							<?php echo CHTML::dropDownList('po_region_id'.$location_number,'region[]',CHtml::listData(Region::model()->findAll("region_id=$region_id ORDER BY name"),'region_id','name'),array(
							'prompt'=>'Select Kadaa',
							'class'=>'region',
							'options' => array($region_id=>array('selected'=>true)),
							)); 

							
							?>
				
					</div>

					<div class="row">
						<?php echo $form->labelEx($model,'Select Locality'); ?>
							<?php echo CHTML::dropDownList('pca_locality_id'.$location_number,'locality[]',CHtml::listData(Locality::model()->findAll("1 ORDER BY name"),'locality_id','name'),array(
							'prompt'=>'Select Locality',
							'class'=>'locality',
							'options' => array($locality_id=>array('selected'=>true))
							)); ?>					
					</div>


					<div class="row inline">
						<?php echo $form->labelEx($model,'Select Village'); ?>
							<?php echo $form->dropDownList($model,'tblLocations[]',CHtml::listData(Location::model()->findAll("location_id=$location_id ORDER BY name"),'location_id','name'),array(
							'prompt'=>'Select Village',
							'class'=>'location',
							'id' => 'po_location_id'.$location_number,
							'options' => array($location_id=>array('selected'=>true)),
							)); 

						
							?>
					</div>
					
       				<!-- <div class="" id="locationDialog_id1"></div> -->
       			</div>
       			<?php } ?>
					<a class="add_another_loc" href = 'javascript:void(0)' style="float:right" >Add Another Village</a>  

	</fieldset>

	<div class="row buttons">
		<?php
		if ($dialog_flag) 
		{
		echo CHtml::ajaxSubmitButton('Add Partner',CHtml::normalizeUrl(array('partnerOrganization/create','render'=>false)),array(
			'beforeSend'=>'js: function(){$("body").undelegate("#closePartnerDialog","click");}',
			'success'=>'js: function(data) {
                        $("#Pca_partner_id").append(data);
                        console.log(data);
                        $("#partnerDialog").dialog("close");
                    }'),array('id'=>'closePartnerDialog')); 
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
<?php if ($dialog_flag) $this->endWidget('zii.widgets.jui.CJuiDialog');?>

</div><!-- form -->