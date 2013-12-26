<?php
/* @var $this GrantController */
/* @var $model Grant */

$this->breadcrumbs=array(
	'Grants'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Grant', 'url'=>array('index')),
	array('label'=>'Create Grant', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#grant-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Grants</h1>

<p>
Search, View and Update Grants.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'partner-organization-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'grant_id',
		//'donor_id',
		'name',
		array(		'name'=>'donor_id',
  					'value'=>'$data->donor->name',),
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
