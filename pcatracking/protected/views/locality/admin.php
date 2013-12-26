<?php
/* @var $this LocalityController */
/* @var $model Locality */

$this->breadcrumbs=array(
	'Localities'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Locality', 'url'=>array('index')),
	array('label'=>'Create Locality', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#locality-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Localities</h1>

<p>
Search, View and Update Localities.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'locality-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		   'name'=>'governorate',
		   'value'=>'$data->region->governorate->name',),	
		array(
		   'name'=>'region',
		   'value'=>'$data->region->name',),	
		'name',
		'cad_code',
		'cas_code',
		'cas_code_un',
		/*
		'cas_village_name',
		*/
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
