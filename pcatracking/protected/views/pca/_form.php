<?php
/* @var $this PcaController */
/* @var $model Pca */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/bootstrap/js/pca/create.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/themes/bootstrap/css/pca/create.css');

?>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'pca-form',
    //'enableAjaxValidation'=>true,
    //'enableClientValidation' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'well'),
    'focus' => array($model, 'number'),
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model, 'number'); ?>
    <?php echo $form->textField($model, 'number', array('size' => 45, 'maxlength' => 45)); ?>
    <?php echo $form->error($model, 'number'); ?>

</div>

<div class="row">
    <?php echo $form->labelEx($model, 'title'); ?>
    <?php echo $form->textField($model, 'title', array('size' => 45, 'maxlength' => 128)); ?>
    <?php echo $form->error($model, 'title'); ?>

</div>

<div class="row">

    <?php echo $form->labelEx($model, 'Select Partner Organization'); ?>
    <?php echo $form->dropDownList($model, 'partner_id', CHtml::listData(PartnerOrganization::model()->findAll(array('order' => 'name ASC')), 'partner_id', 'name'), array('prompt' => 'Select Partner Organization')); ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'ajaxLink',
        'id' => 'showPartnerDialog',
        'label' => 'Create a new Partner',
        'type' => 'info',
        'size' => 'mini',
        'url' => $this->createURL('PartnerOrganization/create'),
        'ajaxOptions' => array(
            'onclick' => '$("#partnerDialog").dialog("open"); return false;',
            'update' => '#partnerDialog',
        ),

    ));?>

    <div id="partnerDialog"></div>
    <?php echo $form->error($model, 'partner_id'); ?>
</div>
<?php


// echo CHtml::ajaxLink(Yii::t('partnerOrganization','Add Partner'),$this->createUrl('PartnerOrganization/create'),array(
//     'onclick'=>'$("#partnerDialog").dialog("open"); return false;',
//     'update'=>'#partnerDialog',
//     ),array('id'=>'showPartnerDialog'));
?>
<div class="row">
    <?php echo $form->labelEx($model, 'initiation_date'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'initiation_date',
        'options' => array(
            'dateFormat' => 'dd-mm-yy',
        ),
        'htmlOptions' => array(// 'size' => '10',         // textField size
            // 'maxlength' => '10',    // textField maxlength
        ),
    ));
    ?>
    <?php echo $form->error($model, 'initiation_date'); ?>
    <?php //echo $form->hiddenField($model,'initiation_date'); ?>
</div>

<div class="row">
    <?php if ($model->pca_id == null) {
        $status_disabled["implemented"] = array('disabled' => 'disabled');
        $status_disabled["canceled"] = array('disabled' => 'disabled');
    }
    $status_disabled[0] = array('disabled' => 'disabled');
    ?>
    <?php echo $form->labelEx($model, 'Select PCA Status'); ?>
    <?php echo $form->dropDownList($model, 'status', $model->pca_status, array(
        'empty' => 'Select PCA Status',
        'options' => $status_disabled
    )); ?>
    <?php echo $form->error($model, 'status'); ?>

</div>

<div class="row">
    <?php echo $form->labelEx($model, 'start_date'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'start_date',
        'options' => array(
            'dateFormat' => 'dd-mm-yy',
        ),
        'htmlOptions' => array(// 'size' => '10',         // textField size
            // 'maxlength' => '10',    // textField maxlength
        ),
    ));
    ?>
    <?php echo $form->error($model, 'start_date'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'end_date'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'end_date',
        'options' => array(
            'dateFormat' => 'dd-mm-yy',
        ),
        'htmlOptions' => array(//  'size' => '10',         // textField size
            //  'maxlength' => '10',    // textField maxlength
        ),
    ));
    ?>
    <?php echo $form->error($model, 'end_date'); ?>
</div>


<div class="row" id="unicef_mgt">
    <div class="row inline" style="margin-right:40px;">
        <?php echo $form->labelEx($model, 'signed_by_unicef_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'signed_by_unicef_date',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
            ),
            'htmlOptions' => array(// 'size' => '10',         // textField size
                // 'maxlength' => '10',    // textField maxlength
            ),
        ));
        ?>
        <?php echo $form->error($model, 'signed_by_unicef_date'); ?>
    </div>

    <div class="row inline">
        <?php echo $form->labelEx($model, 'Unicef PCA Manager Name'); ?>
        <?php echo $form->textField($model, 'unicef_mng_first_name', array('maxlength' => 64, 'placeholder' => 'First Name')); ?>
        <?php echo $form->error($model, 'unicef_mng_first_name'); ?>
    </div>

    <div class="row inline">
        <?php //echo $form->labelEx($model,'unicef_mng_last_name'); ?>
        <?php echo $form->textField($model, 'unicef_mng_last_name', array('maxlength' => 64, 'placeholder' => 'Last Name')); ?>
        <?php echo $form->error($model, 'unicef_mng_last_name'); ?>
    </div>

    <div class="row inline">
        <?php echo $form->labelEx($model, 'Unicef PCA Manager E-mail'); ?>
        <?php echo $form->textField($model, 'unicef_mng_email', array('maxlength' => 128)); ?>
        <?php echo $form->error($model, 'unicef_mng_email'); ?>
    </div>

</div>

<div class="row" id="partner_mgt">
    <div class="row inline" style="margin-right:40px;">
        <?php echo $form->labelEx($model, 'signed_by_partner_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'signed_by_partner_date',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
            ),
            'htmlOptions' => array(
                'size' => '10', // textField size
                'maxlength' => '10', // textField maxlength
            ),
        ));
        ?>
        <?php echo $form->error($model, 'signed_by_partner_date'); ?>
    </div>

    <div class="row inline">
        <?php echo $form->labelEx($model, 'Partner Contact Name'); ?>
        <?php echo $form->textField($model, 'partner_mng_first_name', array('maxlength' => 64, 'placeholder' => 'First Name')); ?>
        <?php echo $form->error($model, 'partner_mng_first_name'); ?>
    </div>

    <div class="row inline">
        <?php // echo $form->labelEx($model,'partner_mng_last_name'); ?>
        <?php echo $form->textField($model, 'partner_mng_last_name', array('maxlength' => 64, 'placeholder' => 'Last Name')); ?>
        <?php echo $form->error($model, 'partner_mng_last_name'); ?>
    </div>

    <div class="row inline">
        <?php echo $form->labelEx($model, 'Partner Contact E-mail'); ?>
        <?php echo $form->textField($model, 'partner_mng_email', array('maxlength' => 128)); ?>
        <?php echo $form->error($model, 'partner_mng_email'); ?>
    </div>

</div>
<br/><br/><br/><br/>

<div class="row">

    <fieldset class="pca_budget">
        <legend>PCA Budget</legend>
        <p>PCA Budget = Partner Contribution Budget + Total UNICEF Contribution Budget</p>
        <?php    if ($model->cash_for_supply_budget == null) $model->cash_for_supply_budget = 0;
        if ($model->in_kind_amount_budget == null) $model->in_kind_amount_budget = 0;
        if ($model->partner_contribution_budget == null) $model->partner_contribution_budget = 0;
        if ($model->unicef_cash_budget == null) $model->unicef_cash_budget = 0;
        ?>
        <div class="row">

            <?php echo $form->labelEx($model, 'partner_contribution_budget'); ?>
            <?php echo $form->numberField($model, 'partner_contribution_budget', array('class' => 'update_total_budget')); ?>
            <?php echo $form->error($model, 'partner_contribution_budget'); ?>

        </div>

        <div class="row inline">

            <?php echo $form->labelEx($model, 'Unicef Cash Budget'); ?>
            <?php echo $form->numberField($model, 'cash_for_supply_budget', array('class' => 'update_unicef_budget')); ?>
            <?php echo $form->error($model, 'cash_for_supply_budget'); ?>

        </div>

        <div class="row inline">

            <p>+</p>

        </div>

        <div class="row inline">

            <?php echo $form->labelEx($model, 'Unicef In Kind Budget'); ?>
            <?php echo $form->numberField($model, 'in_kind_amount_budget', array('class' => 'update_unicef_budget')); ?>
            <?php echo $form->error($model, 'in_kind_amount_budget'); ?>

        </div>


        <div class="row inline">
            <p>=</p>
        </div>

        <div class="row inline">

            <?php echo $form->labelEx($model, 'Total Unicef Contribtuin Budget'); ?>
            <?php echo $form->numberField($model, 'unicef_cash_budget', array('class' => 'update_total_budget')); ?>
            <?php echo $form->error($model, 'unicef_cash_budget'); ?>

        </div>
        <div class="row">

            <?php echo $form->labelEx($model, 'PCA Total Budget'); ?>
            <?php echo $form->numberField($model, 'total_cash'); ?>
            <?php echo $form->error($model, 'total_cash'); ?>

        </div>
    </fieldset>
</div>
<br/><br/><br/><br/>

<div class="row" id="donor_structure">
    <fieldset id="pca_grant_f">
        <legend>Donors Information
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Add Another Donor',
                'id' => 'add_another_donor',
                'url' => 'javascript:void(0)',
                'type' => 'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'mini',
                'htmlOptions' => array('style' => 'float:right', 'class' => 'add_another_donor',) // null, 'large', 'small' or 'mini'
            )); ?>
        </legend>
        <p>Total UNICEF Contribution Budget and Total Donor Amount should match (There are exceptions)</p>
        <?php
        $grants = array();

        if (isset($_POST['Pca']['PcaGrantRel']['grant_id'][0])) {
            echo $_POST['Pca']['PcaGrantRel']['grant_id'][0];
            if (isset($model->pca_id)) {
                $model->transpose($_POST['Pca']['PcaGrantRel'], $post_grants);
                foreach ($post_grants as $key => $value) {
                   // $grants[$key] = PcaGrant::model()->find("pca_id=$model->pca_id AND grant_id = " . $value['grant_id']);
                }
            }
        } else if (isset ($model->PcaGrantRel))$grants = $model->PcaGrantRel;

        //  print_r( $grants[1]);
        // $grants=$grants[1];
        for ($j = 0; $j < sizeof($grants) + 1; $j++) {
            $grant_key = $j + 1;

            if (!isset($grants[$j]['grant_id']) && $j == 0) {

                $donor_id = -1;
                $grant_id = -1;
                $funds = 0;

            } elseif (!isset($grants[$j]['grant_id']) && $j == sizeof($grants)) {
                continue;
            } else {

                $donor_id = $grants[$j]->grant['donor_id'];
                $grant_id = $grants[$j]['grant_id'];
                $funds = $grants[$j]['funds'];


            }
            if ($donor_id == null) $donor_id = -1;
            ?>
            <div class="clone_donor" id="donor_div_id<?php echo $grant_key; ?>">


                <h4>Donor <span class="grant_number"
                                id="grant_number<?php echo $grant_key; ?>"><?php echo $grant_key ?></span></h4>
                <a href="javascript:void(0)" class="inline change_donor remove_donor"
                   id="remove_donor_id<?php echo $grant_key; ?>">Remove Donor <span
                        class="remove_number"><?php echo $grant_key; ?></span></a>

                <div class="row">
                    <?php echo $form->labelEx($model, 'Select Donor'); ?>
                    <?php echo CHtml::dropDownList('donor_id' . $grant_key, '', CHtml::listData(Donor::model()->findAll(array('order' => 'name ASC')), 'donor_id', 'name'), array(
                            'empty' => 'Select Donor',
                            'options' => array($donor_id => array('selected' => true)),
                            'class' => 'donor change_donor',
                        )); ?>
                    <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'ajaxLink',
                        'label' => 'Create a new Donor',
                        'type' => 'info',
                        'size' => 'mini',
                        'url' => $this->createURL('Donor/create'),
                        'htmlOptions' => array('class' => "change_donor donor_dialog_button", 'id' => "showDonorDialog_id$grant_key",),
                        'ajaxOptions' => array(
                            'data' => "number=$grant_key",
                            'onclick' => '$("#donorDialog_id' . $grant_key . '").dialog("open"); return false;',
                            'update' => "#donorDialog_id$grant_key",
                            // 'success'=> ' function(html){ jQuery("#donorDialog_id'.$grant_key.'").html(html);
                            // 	}' ,
                        ),

                    ));?>

                    <div class="change_donor dialog" id="donorDialog_id<?php echo $grant_key; ?>"></div>
                    <?php //echo $form->error($model,'status'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'Select Grant'); ?>
                    <?php echo $form->dropDownList($model, 'PcaGrantRel[grant_id][]', CHtml::listData(Grant::model()->findAll('donor_id=' . $donor_id), 'grant_id', 'name'), array(
                        'empty' => 'Select Grant Number',
                        'id' => 'grant_id' . $grant_key,
                        'options' => array($grant_id => array('selected' => true)),
                        'class' => 'change_donor grant',
                    )); ?>
                    <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'ajaxLink',
                        'label' => 'Create a new Grant',
                        'type' => 'info',
                        'size' => 'mini',
                        'url' => $this->createURL('Grant/create'),
                        'htmlOptions' => array('class' => "change_donor grant_dialog_button", 'id' => "showGrantDialog_id$grant_key",),
                        'ajaxOptions' => array(
                            'data' => "number=$grant_key",
                            'onclick' => '$("#grantDialog_id' . $grant_key . '").dialog("open"); return false;',
                            'update' => "#grantDialog_id$grant_key",
                            // 'success'=> ' function(html){ jQuery("#donorDialog_id'.$grant_key.'").html(html);
                            // 	}' ,
                        ),

                    ));?>

                    <div class="change_donor dialog" id="grantDialog_id<?php echo $grant_key; ?>"></div>
                    <?php //echo $form->error($model,'status'); ?>
                </div>

                <div class="row">

                    <?php echo $form->labelEx($model, 'Donation Amount'); ?>
                    <?php echo $form->numberField($model, 'PcaGrantRel[funds][]', array(
                        'id' => 'funds_id' . $grant_key,
                        'value' => $funds,
                        'class' => 'change_donor funds',
                    )); ?>
                    <?php //echo $form->error($model,'cash_for_supply_budget'); ?>

                </div>
            </div>
        <?php } ?>

        <!-- <a class="add_another_donor" id="add_another_donor" href = 'javascript:void(0)' style="float:right" >Add Another Donor</a>  -->


    </fieldset>
</div>


<br/><br/><br/><br/>

<div class="row" id="pca_overall_structure">
<fieldset class="pca_structure_fs">
<legend>PCA Result Structure
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Add Another Sector',

        'url' => 'javascript:void(0)',
        'type' => 'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size' => 'small',
        'htmlOptions' => array('style' => 'float:right', 'id' => "add_another_sector", 'class' => 'add_link',) // null, 'large', 'small' or 'mini'
    )); ?>
</legend>
<?php

$sectors = array();
//$sectors = $model->PcaSector;
if (isset($_POST['Pca']['PcaSector'][0])) {
    $model->transpose($_POST['Pca']['PcaSector'], $post_sectors);
    foreach ((array)$post_sectors as $key => $value) {
        if ($model->pca_id != NULL)
            $sectors[$key] = PcaSector::model()->find("pca_id=$model->pca_id AND sector_id = " . $value['sector_id']);
    }
} else $sectors = $model->PcaSector;


//echo 2;

for ($i = 0; $i < sizeof($sectors) + 1; $i++) {

    if (!isset($sectors[$i]['sector_id']) && $i == 0) {
        $sector_number = $i + 1;
        $this_sector = array();
        $sector_id = -1;
        $update = false;

    } elseif (!isset($sectors[$i]['sector_id']) && $i == sizeof($sectors)) {
        continue;
    } else {
        $sector_number = $i + 1;
        $this_sector = $sectors[$i];
        $sector_id = $this_sector['sector_id'];
        $update = true;


    }


    ?>

    <div class="pca_single_structure change_sector" id="pca_structure_s<?php echo $sector_number ?>">
    <span><h4>Sector <span id="sector_number"><?php echo $sector_number ?> <a href="javascript:void(0)"
                                                                              class="change_sector remove_sector"
                                                                              id="remove_sector_s<?php echo $sector_number ?>">X</a></span>
        </h4></span>


    <div class="change_sector row" id="s<?php echo $sector_number ?>_sector_id1">

        <?php echo $form->labelEx($model, 'Select Sector'); ?>
        <?php  echo $form->dropDownList($model, 'PcaSector[]', CHtml::listData(Sector::model()->findAll(), 'sector_id', 'name'), array(
                'empty' => 'Select Sector',
                'class' => 'change_sector sector',
                // $disabled_dropdown,
                'id' => 'sector_id_s' . $sector_number,
                'options' => array($sector_id => array('selected' => true))
            )
        );
        ?>
        <?php echo $form->error($model, 'PcaSector'); ?>
        <input type="hidden" class="change_sector sector_number" id="sector_number_s<?php echo $sector_number ?>"
               value="<?php echo $sector_number ?>"/>
    </div>

    <br/>

    <div class="change_sector row" id="rrp5_s1_id<?php echo $sector_number ?>">
        <?php echo $form->labelEx($model, 'Enter RRP Output'); ?>
        <?php
        $rrp5_values = array();
        $rrps = array();
        $rrp5_selected = array();

        if (isset($_POST['Pca']['PcaRrp5Output'][0])) {
            $model->transpose($_POST['Pca']['PcaRrp5Output'], $post_rrps);

            foreach ($post_rrps as $key_rrp => $value_rrp) {
                if ($sector_id != NULL)
                    $rrps[] = Rrp5Output::model()->find("sector_id=$sector_id AND rrp5_output_id = " . $value_rrp);
            }
        } else $rrps = $model->PcaRrp5Output;

        foreach ((array)$rrps as $key => $value) {
            if ($sector_id != $value['sector_id'])
                continue;
            $rpp5_id = $value['rrp5_output_id'];
            $rrp5_selected["$rpp5_id"] = array('selected' => 'selected');
            $rrp5_values[] = $rpp5_id;
        }

        //$rrp5_values = ;
        $this->widget('YumModule.components.select2.ESelect2', array(
            'model' => $model,
            'attribute' => 'PcaRrp5Output[]',
            'htmlOptions' => array(
                'multiple' => 'multiple',
                'style' => 'width:800px',
                'id' => 'rrp5output_s' . $sector_number . '_id1',
                'class' => 'change_sector rrp5output rrp5_s' . $sector_number,
                'options' => $rrp5_selected,
            ),
            'data' => CHtml::listData(Rrp5Output::model()->findAll('sector_id=' . $sector_id), 'rrp5_output_id', 'name'),
            'value' => $rrp5_values,
        )); ?>


        <?php //echo $form->error($model,'PcaRrp5Output'); ?>
    </div>
    <br/>

    <div class="change_sector" id="goal_target_clone_s<?php echo $sector_number ?>">
        <fieldset class="change_sector" id="goal_target_s<?php echo $sector_number ?>_fs">
            <legend>PCA Indicator Beneficiaries

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Add Another Indicator',

                    'url' => 'javascript:void(0)',
                    'type' => 'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'mini',
                    'htmlOptions' => array('style' => 'float:right', 'id' => "add_another_indicator_s" . $sector_number, 'class' => 'add_another_indicator change_sector add_link',) // null, 'large', 'small' or 'mini'
                )); ?>


            </legend>

            <?php
            $target_number = 0;
            $disabled_dropdown = false;
            $first_target_empty = 0;
            $pca_target = array();
            if (isset($_POST['Pca']['PcaTargetProgressRel']['target_progress_id'][0])) {
                $model->transpose($_POST['Pca']['PcaTargetProgressRel'], $post_targets);

                foreach ($post_targets as $key_target => $value_target) {
                    if ($model->pca_id != NULL)
                        $pca_target[] = PcaTargetProgress::model()->find("pca_id=$model->pca_id AND target_progress_id = " . $value_target['target_progress_id']);
                }
            } else if (isset ($model->PcaTargetProgressRel)) $pca_target = $model->PcaTargetProgressRel;


            $target_size = sizeof($pca_target) < 1 ? 1 : sizeof($pca_target);
            for ($j = 0; $j < $target_size + 1; $j++) {

                if (!isset($pca_target[$j]->tpTarget['target_id']) && $j == 0) {

                    $goal_id = -1;
                    $target_id = -1;
                    $hide_tb = 1;
                    $disabled_dropdown = false;

                    $target_number++;
                    $first_target_empty = 1;
                    // echo 2;

                } elseif (!isset($pca_target[$j]->tpTarget['target_id']) && $j == sizeof($pca_target)) {

                    if ($target_number > 0)
                        continue;
                    else {
                        $goal_id = -1;
                        $target_id = -1;
                        $hide_tb = 1;
                        $disabled_dropdown = false;

                        $target_number = 1;

                    }
                } else {

                    $hide_tb = 0;

                    // if ($sector_id != $pca_target[$j]->tpTarget->tpTarget->goal['sector_id'] )
                    if ($sector_id != isset($pca_target[$j]->tpTarget->tpTarget->goal['sector_id']))
                        continue;
                    $next_target = $j + 1;
                    $goal_id = $pca_target[$j]->tpTarget->tpTarget['goal_id'];
                    $target_progress_ids[] = $pca_target[$j]['target_progress_id'];
                    $target_id = $pca_target[$j]->tpTarget['target_id'];
                    $unit_ids[] = $pca_target[$j]->tpTarget['unit_id'];
                    $pca_shortfall[] = $pca_target[$j]['shortfall'];
                    $pca_current[] = $pca_target[$j]['current'];
                    $unit_types[] = $pca_target[$j]->tpTarget->tpUnit['type'];
                    $totals[] = $pca_target[$j]['total'];
                    $target_shortfall[] = $pca_target[$j]->tpTarget['shortfall'];
                    $disabled_dropdown = true;

                    # code...

                    if (isset($pca_target[$next_target]->tpTarget['target_id']))
                    {
                        if ($pca_target[$j]->tpTarget['target_id'] == $pca_target[$next_target]->tpTarget['target_id'])
                            continue;
                    }
                    $target_number++;

                }


                ?>

                <div class="active change_sector change_goal_target row goal_target_s<?php echo $sector_number ?>"
                     id="goal_target_s<?php echo $sector_number; ?>_id<?php echo $target_number; ?>">

                    <h6>Indicator <span class="change_sector change_target target_number_s<?php echo $sector_number ?>"
                                        id="target_number_s<?php echo $sector_number ?>_id<?php echo $target_number; ?>"><?php echo $target_number; ?></span>
                    </h6>
                    <a href="javascript:void(0)" class="inline change_sector change_goal_target remove_target"
                       id="remove_target_s<?php echo $sector_number; ?>_id<?php echo $target_number; ?>">Remove
                        Indicator <span class="remove_number"><?php echo $target_number; ?></span></a>

                    <div class="change_sector change_target row"
                         id="goal_div_s<?php echo $sector_number ?>_id<?php echo $target_number ?>">

                        <?php echo $form->labelEx($model, 'Select CCC'); ?>
                        <?php echo CHtml::dropDownList('pca_goal', '', CHtml::listData(Goal::model()->findAll('sector_id=' . $sector_id), 'goal_id', 'name'), array(
                            'empty' => 'Select CCC',
                            'class' => 'change_sector change_target goal goal_s' . $sector_number,
                            'disabled' => $disabled_dropdown,
                            'id' => 'goal_s' . $sector_number . '_id' . $target_number,
                            'options' => array($goal_id => array('selected' => true)),
                            'value' => $goal_id
                        )); ?>
                        <?php //echo $form->error($model,'PcaGoal'); ?>
                    </div>


                    <?php // echo $form->hiddenField($model,'pcaGoal') ?>
                    <div class="change_sector change_target row"
                         id="target_div_s<?php echo $sector_number ?>_id<?php echo $target_number ?>">
                        <?php echo $form->labelEx($model, 'Select Indicator'); ?>
                        <?php

                        echo CHtml::dropDownList('PcaTarget[]', '', CHtml::listData(Target::model()->findAll('goal_id=' . $goal_id), 'target_id', 'name'), array(
                            'empty' => 'Select Indicator',
                            'class' => 'change_sector change_target  target target_s' . $sector_number,
                            'disabled' => $disabled_dropdown,
                            'id' => 'target_s' . $sector_number . '_id' . $target_number,
                            'options' => array($target_id => array('selected' => true)),
                            'value' => $target_id,
                        )); ?>
                        <?php //echo $form->error($model,'PcaTargetProgressRel'); ?>


                    </div>

                    <div class="change_sector change_target pca_tb row"
                         id="pca_tb_s<?php echo $sector_number ?>_id<?php echo $target_number ?>">
                        <?php if ($hide_tb) {
                            echo '</div>';
                            continue;
                        } ?>

                        <?php echo $this->renderPartial('renderTarget', array('target_progress_ids'=>$target_progress_ids, 'target_ids' => $target_id, 'unit_ids' => $unit_ids, 'unit_types' => $unit_types, 'totals' => $totals, 'target_shortfall' => $target_shortfall, 'pca_shortfall' => $pca_shortfall, 'pca_current' => $pca_current)); ?>

                        <?php
                        $unit_ids = array();
                        $totals = array();
                        $target_shortfall = array();
                        $unit_types = array();
                        $pca_shortfall = array();
                        $pca_current = array();
                        $target_progress_ids = array();

                        ?>
                    </div>
                    <hr>
                </div>
            <?php } ?>
            <?php // if(!$update){ ?>

            <?php //}?>
        </fieldset>
    </div>

    <br/>

    <div class="change_sector" id="ir_wbs_clone_s<?php echo $sector_number ?>">


        <fieldset class="change_sector" id="ir_wbs_s<?php echo $sector_number ?>_fs">
            <legend>PCA WBS Activities
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Add Another Intermediate Result',

                    'url' => 'javascript:void(0)',
                    'type' => 'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'mini',
                    'htmlOptions' => array('style' => 'float:right', 'id' => "add_another_ir_s" . $sector_number, 'class' => 'change_sector add_link add_another_ir',) // null, 'large', 'small' or 'mini'
                )); ?>
            </legend>
            <?php
            $ir_number = 0;
            $pca_wbs = array();

            // if ($_POST['Pca']['PcaWbs'][0] != NULL)
            if (isset($_POST['Pca']['PcaWbs'][0])) {
                $model->transpose($_POST['Pca']['PcaWbs'], $post_wbs);

                foreach ($post_wbs as $key_wbs => $value_wbs) {
                    if ($value_wbs != NULL)
                        $pca_wbs[] = Wbs::model()->find("wbs_id= " . $value_wbs);
                }
            } else if (isset($model->PcaWbs)) $pca_wbs = $model->PcaWbs;


            $ir_size = sizeof($pca_wbs) < 1 ? 0 : sizeof($pca_wbs);
            for ($k = 0; $k < $ir_size + 1; $k++) {

                // if ($pca_wbs[$k]['wbs_id'] == NULL && $k==0)
                if (!isset($pca_wbs[$k]['wbs_id']) && $k == 0) {
                    //$sector_number = $k+1;
                    //$this_sector = array();
                    $ir_id = -1;
                    $wbs_id = -1;

                    # code...
                    $wbs_selected = array();
                    $wbs_values[] = array();
                    $ir_number++;

                } elseif (!isset($pca_wbs[$k]['wbs_id']) && $k == sizeof($pca_wbs)) {
                    continue;
                } else {
                    //$sector_number = $k+1;
                    //$this_sector = $pca_wbs[$k];

                    $ir_id = $pca_wbs[$k]['ir_id'];
                    $wbs_id = $pca_wbs[$k]['wbs_id'];
                    if ($sector_id != $pca_wbs[$k]->IntermediateResult['sector_id'])
                        continue;
                    $next_wbs = $k + 1;


                    # code...
                    $wbs_selected["$wbs_id"] = array('selected' => 'selected');
                    $wbs_values[] = $wbs_id;

                    if (isset($pca_wbs[$next_wbs]['ir_id']))
                    {
                        if ($pca_wbs[$k]['ir_id'] == $pca_wbs[$next_wbs]['ir_id'])
                            continue;

                    }
                    $ir_number++;


                }




                ?>

                <div class="change_sector change_ir_wbs row ir_wbs_s<?php echo $sector_number ?>"
                     id="ir_wbs_s<?php echo $sector_number ?>_id<?php echo $ir_number ?>">

                    <h6>Intermedidate Result <span class="change_ir ir_number_s<?php echo $sector_number ?>"
                                                   id="ir_number_s<?php echo $sector_number ?>_id<?php echo $ir_number ?>"><?php echo $ir_number ?></span>
                    </h6>
                    <a href="javascript:void(0)" class="inline change_sector change_ir remove_ir"
                       id="remove_ir_s<?php echo $sector_number; ?>_id<?php echo $ir_number; ?>">Remove Intermediate
                        Result <span class="remove_number"><?php echo $ir_number; ?></span></a>

                    <div class="change_sector change_ir row"
                         id="ir_s<?php echo $sector_number ?>_id<?php echo $ir_number ?>">

                        <?php echo $form->labelEx($model, 'Select Intermediate Result'); ?>
                        <?php  echo CHtml::dropDownList('ir_s' . $sector_number . '_id' . $ir_number . '', 'IntermediateResult', CHtml::listData(IntermediateResult::model()->findAll('sector_id=' . $sector_id), 'ir_id', 'name'), array(
                                'empty' => 'Select Intermediate Result',
                                //'disabled' => $disabled_dropdown,
                                'class' => 'change_sector change_ir ir ir_s' . $sector_number,
                                'options' => array($ir_id => array('selected' => true)),
                                'value' => $ir_id,
                            )
                        ); ?>

                    </div>
                    <div class="row change_ir"
                         id="change_sector wbs_s<?php echo $sector_number ?>_id<?php echo $ir_number ?>">

                        <?php echo $form->labelEx($model, 'Select WBS/Activity'); ?>
                        <?php $this->widget('YumModule.components.select2.ESelect2', array(
                            'model' => $model,
                            'attribute' => 'PcaWbs[]',
                            'htmlOptions' => array(
                                'multiple' => 'multiple',
                                'style' => 'width:220px',
                                'id' => 'wbs_s' . $sector_number . '_id' . $ir_number,
                                'class' => 'change_sector change_ir wbs',
                                'options' => $wbs_selected,
                            ),
                            'data' => CHtml::listData(Wbs::model()->findAll('ir_id=' . $ir_id), 'wbs_id', 'name'),
                            'value' => $wbs_values,
                        )); ?>

                    </div>
                    <hr>
                </div>


            <?php } ?>


        </fieldset>
    </div>


    <div class="change_sector row" id="act_s1_id<?php echo $sector_number ?>">

        <?php echo $form->labelEx($model, 'Enter Activity'); ?>
        <?php
        $activity_values = array();
        $activities = array();
        $activity_selected = array();

        if (isset($_POST['Pca']['PcaActivity'])) {
            $model->transpose($_POST['Pca']['PcaActivity'], $post_activities);

            foreach ($post_activities as $key_activity => $value_activity) {
                $activities[] = Activity::model()->find("sector_id=$sector_id AND activity_id = " . $value_activity);
            }
        } else $activities = $model->PcaActivity;

        foreach ((array)$activities as $key => $value) {
            if ($sector_id != $value['sector_id'])
                continue;
            $activity_id = $value['activity_id'];
            $activity_selected["$activity_id"] = array('selected' => 'selected');
            $activity_values[] = $activity_id;
        }

        $this->widget('YumModule.components.select2.ESelect2', array(
            'model' => $model,
            'attribute' => 'PcaActivity[]',
            'htmlOptions' => array(
                'multiple' => 'multiple',
                'style' => 'width:800px',
                'id' => 'activity_s' . $sector_number . '_id1',
                'class' => 'change_sector activity activity_s' . $sector_number,
                'options' => $activity_selected,
            ),
            'data' => CHtml::listData(Activity::model()->findAll('sector_id=' . $sector_id), 'activity_id', 'name'),
            'value' => $activity_values,
        )); ?>

    </div>

    <br/>

    </div>

<?php } ?>
<div class="items_to_delete">
    <?php echo CHtml::hiddenField('targets_to_remove', '', array('class' => 'target_to_remove')) ?>
</div>
<br/>
<br/>
</fieldset>
</div>


<div id="loaderDiv" style="display:none; position:fixed; left:40%; top:40%; "><img
        src="<?php echo Yii::app()->baseUrl . '/images/loader.gif' ?>"></div>

<br/><br/><br/><br/>

<div class="row" id="location_row">
<fieldset class="PO-locations">
    <legend>Villages where this PCA will be implemented
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add Another PCA Village',
            // 'id'=> 'add_another_donor',
            'url' => 'javascript:void(0)',
            'type' => 'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'htmlOptions' => array('style' => 'float:right', 'class' => 'addPcaLoc',) // null, 'large', 'small' or 'mini'
        )); ?>
    </legend>
    <?php //print_r($model->GwPcaLocRel[0]['location_id']); //test code.?>
    <div class="location_row">
        <?php if (!isset($model->GwPcaLocRel[0]['location_id'])) { ?>
            <div class="pcaLocationDiv" id='pcaLocationDiv_id1'>
                <h5>Village <span id="locationNumber">1</span></h5>

                <div class="row inline">
                    <?php echo $form->labelEx($model, 'Select Governorate'); ?>
                    <?php  echo CHtml::dropDownList('pca_governorate_id1', '', CHtml::listData(Governorate::model()->findAll(), 'governorate_id', 'name'), array(
                            'prompt' => 'Select Governorate',
                            'class' => 'governorate',

                        )
                    ); ?>
                </div>
                <div class="row inline">
                    <?php echo $form->labelEx($model, 'Select Kadaa'); ?>
                    <?php echo CHTML::dropDownList('pca_region_id1', 'region[]', array(), array(
                        'prompt' => 'Select Kadaa',
                        'class' => 'region',
                    ));?>

                </div>

                <div class="row inline">
                    <?php echo $form->labelEx($model, 'Select Locality'); ?>
                    <?php echo CHTML::dropDownList('pca_locality_id1', 'locality[]', array(), array(
                        'prompt' => 'Select Locality',
                        'class' => 'locality',
                    ));?>

                </div>

                <div class="row inline">
                    <?php echo $form->labelEx($model, 'Select Village'); ?>
                    <?php echo $form->dropDownList($model, 'GwPcaLocRel[location_id][]', array(), array(
                        'prompt' => 'Select Village',
                        'class' => 'location',
                        'id' => 'pca_location_id1',
                    ));

                    //echo CHtml::hiddenField('model_id',$model->pca_id,array());
                    ?>
                </div>
                <div class="row inline">
                    <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'ajaxLink',
                        'label' => 'Create a new Village',
                        'type' => 'info',
                        'size' => 'mini',
                        'url' => $this->createURL('Location/create'),
                        'htmlOptions' => array('class' => "location_dialog_button", 'id' => "showLocationDialog_id1",),
                        'ajaxOptions' => array(
                            'data' => "number=1",
                            'onclick' => '$("#locationDialog_id1").dialog("open"); return false;',
                            'update' => "#locationDialog_id1",
                            // 'success'=> ' function(html){ jQuery("#donorDialog_id'.$grant_key.'").html(html);
                            // 	}' ,
                        ),

                    ));
                    ?>
                </div>
                <div class="" id="locationDialog_id1"></div>
                <?php //echo $form->error($model,'pcaTargetProgressReles'); ?>


                <div class="row">
                    <?php echo $form->labelEx($model, 'Enter Gateway'); ?>
                    <div id="locationSelectDiv">
                        <?php $this->widget('YumModule.components.select2.ESelect2', array(
                            'model' => $model,
                            'attribute' => 'GwPcaLocRel[gateway_id][l1][]',
                            'htmlOptions' => array(
                                'multiple' => 'multiple',
                                'style' => 'width:220px',
                                'id' => 'gateway_id1',
                                'class' => 'multiLoc',
                                //'options' =>$selected,

                            ),
                            'data' => CHtml::listData(Gateway::model()->findAll(), 'gateway_id', 'name'),
                            //'options' => array(1 =>array('selected'=>true)),
                            //'value' => array(8,9,11)
                        )); ?>
                    </div>


                </div>
            </div>


        <?php
        }
        else
        {
        $selected_gw_values = array();
        $row_number = 1;
        foreach ($model->GwPcaLocRel as $key => $value) {
        //	$last_key = end(array_keys($a));
        $next_item = $key + 1;
        $gw_id = $value['gateway_id'];
        $loc_id = $value['location_id'];
        # code...
        $selected_gws["$gw_id"] = array('selected' => 'selected');
        if (isset($model->GwPcaLocRel[$next_item]['location_id']))
        {
            if ($model->GwPcaLocRel[$key]['location_id'] == $model->GwPcaLocRel[$next_item]['location_id'])
                continue;
        }

        ?>

        <div class="pcaLocationDiv" id='pcaLocationDiv1'>
            <h5>Village <span id="locationNumber"><?php echo $row_number ?></span></h5>
            <?php //print_r($model->GwPcaLocRel[$key]['location_id']);
            //echo "<br/>";
            //print_r($model->GwPcaLocRel[$key]['gateway_id']); //test code.
            ?>
            <div class="row inline">
                <?php  echo CHtml::dropDownList('pca_governorate_id' . $row_number, '', CHtml::listData(Governorate::model()->findAll("1 ORDER BY name"), 'governorate_id', 'name'), array(
                        'prompt' => 'Select Governorate',
                        'class' => 'governorate',
                        'options' => array($model->GwPcaLocRel[$key]->Location->locality->region->governorate_id => array('selected' => true))

                    )
                ); ?>
            </div>
            <div class="row inline">
                <?php echo $form->labelEx($model, 'Select Kadaa'); ?>
                <?php echo CHTML::dropDownList('pca_region_id' . $row_number, 'region[]', CHtml::listData(Region::model()->findAll("1 ORDER BY name"), 'region_id', 'name'), array(
                        'prompt' => 'Select Kadaa',
                        'class' => 'region',
                        'options' => array($model->GwPcaLocRel[$key]->Location->locality->region_id => array('selected' => true))
                    )); ?>
            </div>

            <div class="row inline">
                <?php echo $form->labelEx($model, 'Select Locality'); ?>
                <?php echo CHTML::dropDownList('pca_locality_id' . $row_number, 'locality[]', CHtml::listData(Locality::model()->findAll("1 ORDER BY name"), 'locality_id', 'name'), array(
                        'prompt' => 'Select Locality',
                        'class' => 'locality',
                        'options' => array($model->GwPcaLocRel[$key]->Location->locality_id => array('selected' => true))
                    )); ?>
            </div>

            <div class="row inline">
                <?php echo $form->labelEx($model, 'Select Village'); ?>
                <?php echo $form->dropDownList($model, 'GwPcaLocRel[location_id][]', CHtml::listData(Location::model()->findAll("1 ORDER BY name"), 'location_id', 'name'), array(
                    'prompt' => 'Select Village',
                    'class' => 'location',
                    'id' => 'pca_location_id' . $row_number,
                    'options' => array($model->GwPcaLocRel[$key]['location_id'] => array('selected' => true))
                ));

                //echo CHtml::hiddenField('model_id',$model->pca_id,array());
                ?>
                <?php //echo $form->error($model,'pcaTargetProgressReles'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'Enter Gateway'); ?>
                <div class="locationSelectDiv" id="locationSelectDiv<?php echo $row_number; ?>">
                    <?php $this->widget('YumModule.components.select2.ESelect2', array(
                        'model' => $model,
                        'attribute' => 'GwPcaLocRel[gateway_id][l' . $row_number . '][]',
                        'htmlOptions' => array(
                            'multiple' => 'multiple',
                            'style' => 'width:220px',
                            'id' => 'gateway_id' . $row_number,
                            'class' => 'multiLoc',
                            'options' => $selected_gws,
                        ),
                        'data' => CHtml::listData(Gateway::model()->findAll(), 'gateway_id', 'name'),
                        //'options' => array(1 =>array('selected'=>true)),
                        'value' => $selected_gw_values,
                    ));
                    ?>
                </div>

                <?php // echo $form->error($model,'PcaLocation'); ?>
            </div>


            <?php $selected_gws = array();
            $row_number += 1;
            }

            } ?>
        </div>

    </div>

</fieldset>

<br/><br/><br/><br/>

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
                    'afterFileSelect' => 'function(e, v, m){ var cloned_file_dropdown = $("#fileCategory").clone();
 														cloned_file_dropdown.addClass("cloned");		         										
 														$(".MultiFile-label:last").append(cloned_file_dropdown); 
 														$(".cloned").show();
   														}',
                    // 'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                    // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                    // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                    // 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
                ),
            ));?>
        </div>
        <br/>

        <div id="existingFiles">

            <h4> Existing files</h4>

            <?php


            $files = array();

            //              if ($_POST['Pca']['PcaFile'])
            //              {
            //                  $model->transpose($_POST['ExistingFile']['file_content'],$post_files);
            //
            //                  foreach ((array)$post_files as $key_file => $value_file)
            //                  {
            //                      $files[] = UploadedFile::model()->find("file_id=".$value_file);
            //                  }
            //              }
            //              else $files = $model->PcaUFile;
            $files = $model->PcaFile;


            foreach ((array)$files as $key => $value) {


                echo "<div id='fileDiv" . $value['pca_file_id'] . "'>";
                if ($key == 0)
                    echo "<h6>".$model->pca_file_categories[$value['file_category']]."</h6>";
                else if ($value['file_category'] != $model->PcaFile[$key - 1]['file_category'] )
                    echo "<h6>" . $model->pca_file_categories[$value['file_category']] . "</h6>";
                //	echo CHtml::link('x', 'javascript:void(0);', array( 'class'=>'deleteFile '.$value['file_name'], 'id'=>''.$value->pca_file_id));
                echo CHtml::ajaxLink("X", Yii::app()->createUrl('pca/deleteFile', array('pca_id' => $model->pca_id)),
                    array( // ajaxOptions
                        'type' => 'POST',
                        'beforeSend' => "function( request )
                                             {
                                                var r=confirm('Do you want to delete file: " . $value['file_name'] . " ');
                                                if (r==true)
                                                  {

                                                  }
                                                else
                                                  {
                                                    return false;
                                                  }
                                             }",
                        'success' => "function( data )
                                          {
                                            // handle return data
                                            data = data.split(',');
                                            alert(data[0]);
                                            if (data[1] == 'true')
                                            $('#fileDiv'+" . $value['pca_file_id'] . ").remove();
                                          }",
                        'data' => array('file_category' => $value['file_category'], 'file_name' => $value['file_name'], 'file_id' => $value['pca_file_id'])
                    ));

                echo " - ";
                echo CHtml::link($value->file_name, array('displaySavedFile', 'file_category' => $value['file_category'], 'pca_id' => $model->pca_id, 'file_name' => $value['file_name']));
                //echo CHtml::hiddenField('ExistingFile[file_content][]',$value['pca_file_id'],array('id'=>'filehidden'.$value['pca_file_id']));
                echo "<br/>";
                echo "</div>";
                # code...
            }
            ?>

        </div>

    </fieldset>



	<span id="fileCategory" style="display:none">
	    <?php echo CHtml::dropDownList('UploadedFile[file_category][]', '', $model->pca_file_categories); ?>
	</span>

</div>
<br/><br/>
<?php echo $form->hiddenField($model, 'received_date', array('value' => date("Y-m-d H:i:s"))); ?>



<div class="row buttons">
    <?php  $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'id' => 'submit',
        'htmlOptions' => array(
            'id' => 'submit',),

        'label' => $model->isNewRecord ? 'Create' : 'Save',
        'type' => 'primary'
    ));
    ?>
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

</div>
<!-- form -->