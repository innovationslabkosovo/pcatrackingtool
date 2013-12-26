<?php
/* @var $this PartnerOrganizationController */
/* @var $model PartnerOrganization */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/partnerOrganization/admin.js');

$this->breadcrumbs=array(
	'Partner Organizations'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List PartnerOrganization', 'url'=>array('index')),
	array('label'=>'Create Partner Organization', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#partner-organization-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Partner Organizations</h1>

<p>
Search, View, Update, and Delete Partner Organizations.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

 <form action="generateExcel" method="post" name="form-excel" id="form-excel">
		 <input type="hidden" name="hidden_excel[]" id="hidden_excel" />
		  <img style="float:right;cursor:pointer" id="export_excel_button" src="<?php echo Yii::app()->baseUrl.'/images/excel37X35.png'; ?>">
		  
    </form>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'partner-organization-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'partner_id',
		'name',
		'description',
		array(	
			'name'=>'POlocation',
  			'header'=>'Village',
   			'value'=>'$data->getRelatedActivities($data->tblLocations, "name")'),
		array(	
			'name'=>'POlocality',
  			'header'=>'Locality',
   			'value'=>'$data->getRelatedActivities($data->tblLocations, "name", array("locality"))'),
		array(	
			'name'=>'POregion',
  			'header'=>'Kadaa',
   			'value'=>'$data->getRelatedActivities($data->tblLocations, "name", array("locality","region"))'),
		
		array(
			'name'=>'POgovernorate',
  			'header'=>'Governorate',
   			'value'=>'$data->getRelatedActivities($data->tblLocations, "name", array("locality","region","governorate"))'),
		
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
  <div>

  </div>