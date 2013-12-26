<?php
/* @var $this PcaController */
/* @var $model Pca */
/* @var $form CActiveForm */
?>
<br/>
<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

<!-- pca attributes -->
	<fieldset>
		<legend>PCA Details</legend>


		<div class="section" >
			<div class="row line1" >
				<?php echo $form->label($model,'number'); ?>
				<?php echo $form->textField($model,'number'); ?>
			</div>

			<div class="row line3">
				<?php echo $form->label($model,'partner'); ?>
				<?php echo $form->textField($model,'partner'); ?>
			</div>

			<div class="row line2">
				<?php echo $form->label($model,'start_date'); ?>
				<?php $attribute = 'start_date';
					for ($i = 0; $i <= 1; $i++)
					{
					    echo ($i == 0 ? Yii::t('main', 'From:<br/>') : Yii::t('main', '<br/>To:<br/>'));
					    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					        'id'=>CHtml::activeId($model, $attribute.'_'.$i),
					        'model'=>$model,
					        'options' =>array(			    	 		
									     	'dateFormat' => 'dd-mm-yy', 					   
							    	), 
					        'attribute'=>$attribute."[$i]",
					    )); 
					}
				?>
			</div>
			
			
		</div>
		
		<div class="section" >

			<div class="row line1" >
				<?php echo $form->label($model,'title'); ?>
				<?php echo $form->textField($model,'title'); ?>
			</div>
		
			<div class="row line3">
				<?php echo $form->label($model,'partner_contribution_budget'); ?>
				<?php echo $form->textField($model,'partner_contribution_budget'); ?>
			</div>


			<div class="row line2">
				<?php echo $form->label($model,'end_date'); ?>
				<?php $attribute = 'end_date';
					for ($i = 0; $i <= 1; $i++)
					{
					    echo ($i == 0 ? Yii::t('main', 'From:<br/>') : Yii::t('main', '<br/>To:<br/>'));
					    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					        'id'=>CHtml::activeId($model, $attribute.'_'.$i),
					        'model'=>$model,
					        'options' =>array(			    	 		
									     	'dateFormat' => 'dd-mm-yy', 					   
							    	), 
					        'attribute'=>$attribute."[$i]",
					    )); 
					}
				?>
			</div>

			
		</div>

		<div class="section" >
			<div class="row line1" >
				<?php echo $form->label($model,'status'); ?>
				<?php echo $form->textField($model,'status'); ?>
			</div>

			
			<div class="row line3">
				<?php echo $form->label($model,'unicef_cash_budget'); ?>
				<?php echo $form->textField($model,'unicef_cash_budget'); ?>
			</div>

			<div class="row line2">
				<?php echo $form->label($model,'initiation_date'); ?>
				<?php $attribute = 'initiation_date';
					for ($i = 0; $i <= 1; $i++)
					{
					    echo ($i == 0 ? Yii::t('main', 'From:<br/>') : Yii::t('main', '<br/>To:<br/>'));
					    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					        'id'=>CHtml::activeId($model, $attribute.'_'.$i),
					        'model'=>$model,
					        'options' =>array(			    	 		
									     	'dateFormat' => 'dd-mm-yy', 					   
							    	), 
					        'attribute'=>$attribute."[$i]",
					    )); 
					}
				?>
			</div>
		</div>

	</fieldset>
<!-- pca attributes -->

<!-- donor attributes -->
	<fieldset>
		<legend>Donor Details</legend>
		<div class="section" >
			<div class="row">
				<?php echo $form->label($model,'assignedDonors'); ?>
				<?php echo $form->textField($model,'assignedDonors'); ?>
			</div>
		</div>
		<div class="section" >
			<div class="row">
				<?php echo $form->label($model,'assignedGrants'); ?>
				<?php echo $form->textField($model,'assignedGrants'); ?>
			</div>
		</div>
		<div class="section" >
			<div class="row">
				<?php echo $form->label($model,'assignedFunds'); ?>
				<?php echo $form->textField($model,'assignedFunds'); ?>
			</div>
		</div>

	</fieldset>
<!-- donor attributes -->


<!-- target attributes -->
	<fieldset>
		<legend>Indicator Details</legend>
		<div class="section" style="margin-right:30px">
			<div class="row">
				<?php  //echo $form->label($model,'assignedIndicators'); ?>
				<?php //echo $form->textField($model,'assignedIndicators'); ?>
			</div>

			<div class="row" >
				<?php echo $form->label($model,'assignedUnits'); ?>
				<?php echo $form->textField($model,'assignedUnits', array('placeholder'=>'children, school...')); ?>
			</div>
		</div>

		<div class="section" style="margin-right:30px">
			<div class="row">
				<?php echo $form->label($model,'assignedTotals'); ?>
				<?php echo $form->textField($model,'assignedTotals'); ?>
			</div>
		</div>
		<div class="section" style="margin-right:30px">
			<div class="row">
				<?php echo $form->label($model,'assignedCurrents'); ?>
				<?php echo $form->textField($model,'assignedCurrents'); ?>
			</div>
		</div>
		<div class="section" style="margin-right:30px">
			<div class="row">
				<?php echo $form->label($model,'assignedShortfalls'); ?>
				<?php echo $form->textField($model,'assignedShortfalls'); ?>
			</div>
		</div>
		
	</fieldset>
<!-- target attributes -->


<!-- wbs rrp attributes -->
	<fieldset>
		<legend>Intermediate Result and WBS Activity Details</legend>
		<div class="section" >
			<div class="row">
				<?php echo $form->label($model,'assignedIRs'); ?>
				<?php echo $form->textField($model,'assignedIRs'); ?>
			</div>
		</div>
		<div class="section" >
			<div class="row">
				<?php echo $form->label($model,'assignedWbs'); ?>
				<?php echo $form->textField($model,'assignedWbs'); ?>
			</div>
		</div>
	
	</fieldset>
<!-- wbs rrp attributes -->


<!-- location attributes -->
	<fieldset>
		<legend>Village Details</legend>
		<div class="section" >
			<div class="row">
				<?php echo $form->label($model,'assignedLocations'); ?>
				<?php echo $form->textField($model,'assignedLocations'); ?>
			</div>
		</div>
		<div class="section" >
			<div class="row">
				<?php echo $form->label($model,'assignedRegions'); ?>
				<?php echo $form->textField($model,'assignedRegions'); ?>
			</div>
		</div>
		<div class="section" >
			<div class="row">
				<?php echo $form->label($model,'assignedGovs'); ?>
				<?php echo $form->textField($model,'assignedGovs'); ?>
			</div>
		</div>
		
	</fieldset>
<!-- location attributes -->




	<br/>

	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>'Search',
		    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'medium',
		    //'block'=>true,
		    'buttonType'=>'submit' // null, 'large', 'small' or 'mini'
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->