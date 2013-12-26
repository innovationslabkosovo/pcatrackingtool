<?php
/* @var $this IntermediateResultController */
/* @var $model IntermediateResult */

$this->breadcrumbs=array(
	'Intermediate Results'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List IntermediateResult', 'url'=>array('index')),
	array('label'=>'Create Intermediate Result', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#intermediate-result-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Intermediate Results</h1>

<p>
Search, View and Update Intermediate Results.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'intermediate-result-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ir_id',
		array(
		'name'=>'sector_id',
		'value'=>'$data->sector->name',
		),
		'ir_wbs_reference',
		'name',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
