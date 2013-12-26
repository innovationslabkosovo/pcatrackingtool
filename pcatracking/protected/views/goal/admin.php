<?php
/* @var $this GoalController */
/* @var $model Goal */

$this->breadcrumbs=array(
	'CCCs'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Goal', 'url'=>array('index')),
	array('label'=>'Create CCC', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#goal-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage CCCs</h1>

<p>
Search, View, Update, and Delete CCCs.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'goal-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'goal_id',
		array(		'name'=>'sector',
  					'value'=>'$data->sector->name',),
		'name',		
		'description',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
