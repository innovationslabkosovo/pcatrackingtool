<?php
/* @var $this PcaReportController */
/* @var $model PcaReport */
/* @var $form CActiveForm */
 Yii::app()->clientScript->registerCoreScript('jquery');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/pcaReport/create.js');
?>


<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'pca-report-form',
	'enableAjaxValidation'=>false,
	 'htmlOptions' => array('enctype' => 'multipart/form-data', 'class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->labelEx($model, 'Select Sector'); ?>
    <?php  echo CHtml::dropDownList('sector_id','',CHtml::listData(Sector::model()->findAll(),'sector_id','name'),array(
            'ajax' => array(
                'type'=>'POST', //request type
                'url'=>$this->createUrl('pcaReport/returnSectorPcas'), //url to call.
                //Style: CController::createUrl('currentController/methodToCall')
                'update'=>'#pca_ids', //selector to update
                'data'=>array('sector_id'=>'js:$(this).val()'),
//                'success'=> "function(data) {
//									 							data = data.split('nextitem;');
//									 							$('#Target_goal_id').html(data);
//
//									 						}"
                //leave out the data key to pass all form values through
            ),
            'prompt'=>'Select Sector',


        )
    ); ?>


	<div class="row">
		
		<?php echo $form->labelEx($model,'pca_id'); ?>	
			<?php $this->widget('YumModule.components.select2.ESelect2', array(
								'model' => $model,
								'attribute' => 'pca_id',
								'htmlOptions' => array(
									//'multiple' => 'false',
									'style' => 'width:520px',
									'prompt'=>'Select PCA',
                                    'id'=> 'pca_ids',
														
									),
								//'data' => CHtml::listData(Pca::model()->findAll(),'pca_id','title'),
								//'options' => array(1 =>array('selected'=>true)),
								
							)); 
							?>
		<?php //echo $form->dropDownList($model,'pca_id',CHtml::listData(Pca::model()->findAll(),'pca_id','number'),array('prompt'=>'Select PCA')); ?>
		<?php echo $form->error($model,'pca_id'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>

	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>45,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'description'); ?>

	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'start_period'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'model' => $model,
			    'attribute' => 'start_period',
			    'options' => array(
					        'dateFormat' => 'dd-mm-yy', 
					        ), 
			    'htmlOptions' => array(
			       // 'size' => '10',         // textField size
			       // 'maxlength' => '10',    // textField maxlength
			    	),
				));
		?>
		<?php echo $form->error($model,'start_period'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_period'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'model' => $model,
			    'attribute' => 'end_period',
			    'options' => array(					           
					        'dateFormat' => 'dd-mm-yy',  ), 
			    'htmlOptions' => array(
			      //  'size' => '10',         // textField size
			      //  'maxlength' => '10',    // textField maxlength
			    	),
				));
		?>
		<?php echo $form->error($model,'end_period'); ?>
	</div>

	

	<div class="row" id="targetBen">
		<fieldset >
	 		<legend class="targetBenLegend">PCA Indicator Beneficiaries</legend>
	 		<div id="pcaTargets">
	 		<?php echo $form->error($model,'assignedTargets'); ?>
	 		</div>
	 	</fieldset>
	</div>


    <div class="row" id="file_row">
        <fieldset class="pca_files">
            <legend>Manage PCA Files:</legend>
            <div id="newFiles">
                <h4> Add new files</h4>
                <?php
                $this->widget('CMultiFileUpload', array(
                    //'model'=>new UploadedFile,
                    //'attribute'=>'file_content',
                    'name' => 'files',
                    'accept' => 'jpg|gif|doc|pdf|docx|odt|xls|xlsx|zip',
                    'options' => array(
                        // 'onFileSelect'=>'function(e, v, m){ }',
                        // 'afterFileSelect' => 'function(e, v, m){ }',
                        // 'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                        // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                        // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                        // 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
                    ),
                ));?>
            </div>
        </fieldset>
    </div>
	<div class="row">
		<?php echo $form->hiddenField($model,'received_date',array('value'=>date("Y-m-d H:i:s"))) ?>
	</div>
	<br/>
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