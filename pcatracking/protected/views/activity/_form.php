<?php
/* @var $this ActivityController */
/* @var $model Activity */
/* @var $form CActiveForm */

// if ($dialog_flag) {
if ( isset($dialog_flag) ) {
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'options' => array(
            'id' => 'activityDialog',
            'title' => Yii::t('activity', 'Add Activity'),
            'autoOpen' => true,
            'modal' => 'true',
            'width' => '1000px',
            'height' => 'auto',
        ),
    ));
}
?>


<div class="form">


    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'activity-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'well'),
    )); ?>

    <?php echo CHtml::hiddenField('dialog_flag', isset($dialog_flag)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'sector_id'); ?>
        <?php echo $form->dropDownList($model, 'sector_id', CHtml::listData(Sector::model()->findAll(), 'sector_id', 'name'), array('empty' => 'Select Sector',)); ?>
        <?php echo $form->error($model, 'sector_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'type'); ?>
        <?php //echo $form->textField($model,'type',array('size'=>30,'maxlength'=>30));
        //echo $form->dropDownList($model, 'type', array('Health' => 'Health', 'Nutrition' => 'Nutrition', 'Protection'=>'Protection', 'Supplies'=>'Supplies', 'Training'=>'Training'));
        ?>
        <?php //echo $form->error($model,'type'); ?>
    </div>
    <!-- 	<p>
		Chose the Targets that this activity is associated with:
	</p>
	<div class="row">
	<?php //$model->TargetActivity = array_keys(CHtml::listData($model->TargetActivity, 'target_id' , 'target_id'));
			  //echo $form->checkBoxList($model,'TargetActivity',CHtml::listData(Target::model()->findAll(),'target_id','name')); ?>
	</div>
	<hr> -->

    <?php //echo $form->checkBox($model,'noTarget', array('value' => '1', 'uncheckValue'=>'0')); ?>

    <div class="row buttons">
        <?php
        // if ($dialog_flag) {
        if ( isset($dialog_flag) ) {
            echo CHtml::ajaxSubmitButton('Add Activity', CHtml::normalizeUrl(array('activity/create', 'render' => false)), array(
                'beforeSend' => 'js: function(){$("body").undelegate("#closeActivityDialog","click");}',
                'success' => 'js: function(data) {
                        $("#Pca_activity_id").append(data);
                        console.log(data);
                        $("#activityDialog").dialog("close");
                    }'), array('id' => 'closeActivityDialog'));
        } else {
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'id' => 'submit',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
                'type' => 'primary'
            ));
        }

        ?>
    </div>

    <?php $this->endWidget(); ?>
    <?php if ( isset($dialog_flag) ) $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

</div><!-- form -->