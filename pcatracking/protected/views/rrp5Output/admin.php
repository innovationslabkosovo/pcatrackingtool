<?php
/* @var $this Rrp5OutputController */
/* @var $model Rrp5Output */

$this->breadcrumbs=array(
	'RRP Outputs'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List RRP5 Outputs', 'url'=>array('index')),
	array('label'=>'Create RRP Output', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rrp5-output-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage RRP Outputs</h1>

<p>
Search, View and Update RRP Outputs.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'rrp5-output-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'rrp5_output_id',
		array(		'name'=>'sector',
  					'value'=>'$data->sector->name',),
		'name',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
