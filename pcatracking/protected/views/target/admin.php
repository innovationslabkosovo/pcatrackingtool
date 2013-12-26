<?php
/* @var $this TargetController */
/* @var $model Target */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/target/admin.js');

$this->breadcrumbs=array(
	'Indicators'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Indicator', 'url'=>array('index')),
	array('label'=>'Create Indicator', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#target-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Indicators</h1>

<p>
Search, View and Update Indicators.
</p>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
 <form action="generateExcel" method="post" name="form-excel" id="form-excel">
		 <input type="hidden" name="hidden_excel[]" id="hidden_excel" />
		  <img style="float:right;cursor:pointer" id="export_excel_button" src="<?php echo Yii::app()->baseUrl.'/images/excel37X35.png'; ?>">
		  
    </form>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'target-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'target_id',
		array(
			'name'=>'sector',
			'value'=>'$data->goal->sector->name',

		),
		array(
			'name'=>'goal',
			'value'=>'$data->goal->name',

		),
		'name',
		array(
			'name'=>'assignedUnits',
			'value'=>'$data->getRelatedActivities($data->TargetProgressRel, "type", array("tpUnit"))'
			),
		array(
			'name'=>'assignedTotals',
			'value'=>'$data->getRelatedActivities($data->TargetProgressRel, "total")'
			),
		array(
			'name'=>'assignedProgrammed',
			'value'=>'$data->getRelatedActivities($data->TargetProgressRel, "current")'
			),
		array(
			'name'=>'assignedShortfalls',
			'value'=>'$data->getRelatedActivities($data->TargetProgressRel, "shortfall")'
			),
		// array(
  //           'name'=>'assignedCCCs',
		// 	'type'=>'raw',
  //           'value'=> '$data->getRelatedActivities($data->PcaTargetProgressRel, "name", array("tpTarget","tpTarget","goal"))'
  //           ),
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        	),

		),
		
	)
); ?>
