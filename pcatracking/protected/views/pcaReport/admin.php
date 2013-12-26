<?php
/* @var $this PcaReportController */
/* @var $model PcaReport */

$this->breadcrumbs=array(
	'PCA Reports'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List PcaReport', 'url'=>array('index')),
	array('label'=>'Create PCA Report', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pca-report-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage PCA Reports</h1>

<p>
Search, Update, and View PCA Reports. 
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'pca-report-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		//'pca_report_id',
		array(
		   'name'=>'pca',
		   'value'=>'$data->pca->title',),
		'start_period',
		'end_period',
		'received_date',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
