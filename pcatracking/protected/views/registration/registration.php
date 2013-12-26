
<h2> My Registration Page </h2>

<p> Hi there, please enter your E-Mail address and drop a note about you </p>

<? $this->breadcrumbs = array(Yum::t('Registration')); ?>

<div class="form">
<? $activeform = $this->beginWidget('CActiveForm', array(
			'id'=>'registration-form',
			'enableAjaxValidation'=>false,
			'focus'=>array($profile,'email'),
			));
?>

<? echo Yum::requiredFieldNote(); ?>
<? echo CHtml::errorSummary($profile); ?>

<div class="row"> <?
echo $activeform->labelEx($profile,'email');
echo $activeform->textArea($profile,'email');
?> </div>  

<div class="row"> <?
echo $activeform->labelEx($profile,'about');
echo $activeform->textArea($profile,'about');
?> </div>  

<div class="row submit">
	<? echo CHtml::submitButton(Yum::t('Registration')); ?>
</div>

<? $this->endWidget(); ?>