<?php
/* @var $this WbsController */
/* @var $model Wbs */

$this->breadcrumbs=array(
	'WBS/Activity'=>array('index'),
	'Manage WBS/Activity',
);

$this->menu=array(
	//array('label'=>'List Wbs', 'url'=>array('index')),
	array('label'=>'Create WBS/Activity', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#wbs-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage WBS</h1>

<!-- <p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p> -->

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'wbs-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'wbs_id',
		array(
		'name'=>'wbs_sector',
		'value'=>'$data->IntermediateResult->sector->name',
		),
		array(
		'name'=>'ir_id',
		'value'=>'$data->IntermediateResult->name',
		),
		'name',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
