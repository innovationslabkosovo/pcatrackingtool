<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Kadaas'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Region', 'url'=>array('index')),
	array('label'=>'Create Kadaa', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#region-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Kadaas</h1>

<p>
Search, View and Update Kadaas.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'region-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'region_id',
		array('name'=>'governorate',
  			'value'=>'$data->governorate->name',),
		'name',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
