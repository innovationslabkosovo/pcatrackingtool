<?php
/* @var $this TargetController */
/* @var $model Target */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/bootstrap/js/target/create.js');
$sector_id = "sector_id = 99";
$disabled_dropdown = false;
if (isset($model->goal->sector_id)) {
    $sector_id = 'sector_id = ' . $model->goal->sector_id;
    $disabled_dropdown = true;
}



?>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'target-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php //echo $form->labelEx($model,'goal_id'); ?>
    <?php // echo $form->textField($model,'goal_id'); ?>
    <?php //echo $form->error($model,'goal_id'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'Select Sector'); ?>
    <?php  echo CHtml::dropDownList('sector_id', '', CHtml::listData(Sector::model()->findAll(), 'sector_id', 'name'), array(
            'ajax' => array(
                'type' => 'POST', //request type
                'url' => $this->createUrl('pca/returnparent'), //url to call.
                //Style: CController::createUrl('currentController/methodToCall')
                //'update'=>'#Target_goal_id', //selector to update
                'data' => array('fk_val' => 'js:$(\'#sector_id\').val()', 'current_model' => 'goal', 'pk' => 'goal_id', 'name' => 'name', 'fk_name' => 'sector_id'),
                'success' => "function(data) {
									 							data = data.split('nextitem;');
									 							$('#Target_goal_id').html(data);
									 							
									 						}"
                //leave out the data key to pass all form values through
            ),
            'prompt' => 'Select Sector',
            'disabled' => $disabled_dropdown,
            // 'options' => array($model->goal->sector_id=>array('selected'=>true))
            'options' => array($sector_id => array('selected' => true))
        )
    ); ?>
    <?php //echo $form->error($model,'pcaTargetProgressReles'); ?>
</div>

<div class="row">
    <?php //echo $form->labelEx($model,'Select RRP Output'); ?>
    <?php //echo $form->dropDownList($model,'rrp5_output_id',CHtml::listData(Rrp5Output::model()->findAll($sector_id),'rrp5_output_id','name'),array('prompt'=>'Select RRP Output')); ?>
    <?php //echo $form->error($model,'rrp5_output_id'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'Select CCC'); ?>
    <?php echo $form->dropDownList($model, 'goal_id', CHtml::listData(Goal::model()->findAll($sector_id), 'goal_id', 'name'), array('prompt' => 'Select CCC', 'disabled' => $disabled_dropdown)); ?>
    <?php //echo $form->error($model,'pcaTargetProgressReles'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textArea($model, 'name', array('size' => 60)); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>


<fieldset class="targetProgressLegend">
    <legend>Results achievable through programmed activity against Total RRP Targets:

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add Another Unit',

            'url' => 'javascript:void(0)',
            'type' => 'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'htmlOptions' => array('style' => 'float:right', 'id' => "add_another_unit", 'class' => 'add_another_unit',) // null, 'large', 'small' or 'mini'
        )); ?>

    </legend>



    <?php //if (!isset($model->TargetProgressRel[0]) ) {?>
    <?php if (!isset($model->TargetProgressRel[0])) { ?>
        <div class="unit_to_clone" id="unit_total_id1">

            <h5 class="inline">Unit <span class="inline unit_number">1</span></h5>

            <a href="javascript:void(0)" class="inline change_unit remove_unit" id="remove_unit_id1">Remove Unit <span
                    class="remove_number">1</span></a>

            <?php echo CHtml::hiddenField('hidden_unit_number_id1', 1, array('class' => 'hidden_unit_number')); ?>

            <div class="row">
                <?php // echo $form->labelEx($model,'Unit'); ?>
                <?php echo $form->dropDownList($model, 'TargetProgressRel[unit_id][]', CHtml::listData(Unit::model()->findAll(), 'unit_id', 'type'), array(
                    'prompt' => 'Select Unit',
                    'class' => 'change_unit unit',
                    'id' => 'unit_id1',

                )); ?>
                <?php //echo $form->error($model,'pcaTargetProgressReles'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'total_RRP5_target'); ?>
                <?php echo $form->textField($model, 'TargetProgressRel[total][]', array(
                    'size' => 45,
                    'maxlength' => 45,
                    'class' => 'change_unit total',
                    'id' => 'total_id1',
                )); ?>
                <?php echo $form->labelEx($model, 'Start Date'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                        'model' => $model,
//                        'attribute' => 'end_date',
                    'name' => 'targetChange[start_date][]',
                    'options' => array(
                        'dateFormat' => 'dd-mm-yy',
                    ),
                    'htmlOptions' => array(
                        'id'=> 'start_date_id1',
                        'class'=> 'change_unit start_date',

                    ),
                )); ?>
                <?php echo $form->error($model, 'TargetProgressRel'); ?>
                <?php echo $form->hiddenField($model, 'TargetProgressRel[received_date][]', array('value' => date("Y-m-d H:i:s"))) ?>
                <?php //echo $form->hiddenField($model,'TargetProgressRel[active][]', array('value'=>1));?>
                <?php echo $form->hiddenField($model, 'TargetProgressRel[current][]', array('value' => 0, 'class' => 'hiddencurrent')) ?>


            </div>

        </div>
    <?php
    } else {
        // if ($_POST['Target']['TargetProgressRel'] != NULL) $post_data = array_filter($_POST['Target']['TargetProgressRel']);
        if (isset($_POST['Target']['TargetProgressRel'])) $post_data = array_filter($_POST['Target']['TargetProgressRel']);
        if (!empty($post_data)) $this->transpose($post_data, $target_units);
        else $target_units = $model->TargetProgressRel;


        foreach ($target_units as $key => $value) {

            $unit_number = $key + 1;
            ?>
            <div class="unit_to_clone" id="unit_total_id<?php echo $unit_number ?>">

                <?php echo $form::hiddenField($model, 'TargetProgressRel[target_progress_id][]', array('value' => $value['target_progress_id'], 'class' => 'target_progress_id')); ?>

                <h5>Unit <span class="unit_number"><?php echo $unit_number; ?></span></h5>
                <a href="javascript:void(0)" class="inline change_unit remove_unit"
                   id="remove_unit_id<?php echo $unit_number ?>">Remove Unit <span
                        class="remove_number"><?php echo $unit_number; ?></span></a>

                <?php echo CHtml::hiddenField('hidden_unit_number_id' . $unit_number, $unit_number, array('class' => 'hidden_unit_number change_unit')); ?>

                <div class="row unit_row" id="unit_row_id<?php echo $unit_number ?>">

                    <?php // echo $form->labelEx($model,'Unit'); ?>
                    <?php echo $form->dropDownList($model, 'TargetProgressRel[unit_id][]', CHtml::listData(Unit::model()->findAll(), 'unit_id', 'type'), array(
                        'prompt' => 'Select Unit',
                        'options' => array($value['unit_id'] => array('selected' => true)),
                        'class' => 'change_unit unit',
                        'id' => 'unit_id' . $unit_number,

                    )); ?>
                    <?php //echo $form->error($model,'pcaTargetProgressReles'); ?>
                </div>


                <div class="row total_row" id="total_row_id<?php echo $unit_number ?>">
                    <?php echo $form->labelEx($model, 'Total RRP5 Target'); ?>
                    <?php // echo $form->textField($model,'TargetActivity',array('size'=>45,'maxlength'=>45)); ?>
                    <?php echo $form->textField($model, 'TargetProgressRel[total][]', array(
                        'size' => 45, 'maxlength' => 45,
                        'value' => $value['total'],
                        'class' => 'change_unit total',
                        'id' => 'total_id' . $unit_number,

                    )); ?>
                    <?php //echo $form->error($model,'TargetProgressRel'); ?>
                    <?php echo $form->hiddenField($model, 'TargetProgressRel[received_date][]', array('value' => date("Y-m-d H:i:s"))) ?>
                    <?php echo $form->hiddenField($model, 'TargetProgressRel[current][]', array('value' => $value['current'], 'class' => 'hiddencurrent')) ?>
                    <?php //echo $form->hiddenField($model,'TargetProgressRel[active][]', array('value'=>1));?>
                    <?php echo "Programmed Target:<span id='prog_target'>" . $value['current'] . "</span>" ?>


                </div>
            </div>
        <?php }
    } ?>

    <?php echo CHtml::hiddenField('units_to_remove', '', array('class' => 'unit_to_remove')) ?>
</fieldset>


<!-- <fieldset class="targetActivities">
     <legend>Target Activities</legend>
<div class="row"> -->
<?php // echo $form->labelEx($model,'Choose Target Activities'); ?>
<?php //$model->TargetActivity = array_keys(CHtml::listData($model->TargetActivity, 'activity_id' , 'activity_id'));
// echo $form->checkBoxList($model,'TargetActivity',CHtml::listData(Activity::model()->findAll(),'activity_id','name'));
?>
<?php //echo CHtml::ajaxLink(Yii::t('Activity','Add Acitvity'),$this->createUrl('Activity/create'),array(
// 'onclick'=>'$("#activityDialog").dialog("open"); return false;',
// 'update'=>'#activityDialog',
//  ),array('id'=>'showActivityDialog'));
?>
<!-- <div id="activityDialog"></div> -->
<!-- </div>
</fieldset> -->
<br/>

<div class="row buttons">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'id' => 'submit',
        'htmlOptions' => array('style' => 'display:inline'),
        'label' => $model->isNewRecord ? 'Create' : 'Save',
        'type' => 'primary',
        'size' => 'medium'
    ));?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'id' => 'cancel_changes',
        'htmlOptions' => array(
            'style' => 'display:inline',
            'onClick' => 'window.location="' . Yii::app()->getRequest()->getUrl() . '"'),
        'label' => 'Cancel',
        'type' => 'danger',
        'size' => 'medium'
    ));?>
</div>



<?php $this->endWidget(); ?>

</div><!-- form -->