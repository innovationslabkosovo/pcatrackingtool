<?php
/* @var $this PcaController */
/* @var $model Pca */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/themes/bootstrap/js/pca/admin.js');

$this->breadcrumbs=array(
	'PCAs'=>array('index'),
	'Manage',
);


$this->menu=array(
	//array('label'=>'List Pca', 'url'=>array('index')),
	array('label'=>'Create PCA', 'url'=>array('create')),
);

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/themes/bootstrap/css/pca/admin.css');
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pca-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage PCAs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

  <?php
  //print_r($model->search()->getItemCount());
 //  foreach ($model->search() as $key => $value) {
  	# code...
  	//	print_r($key);
 // } 
 // echo $model->search()->getItemCount();
  ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>'Advanced Search',
		    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'medium',
		    'htmlOptions'=>array(
		    'class'=>'search-button',
		    
		    )
		   
		)); ?>

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
	'id'=>'pca-grid',
	'type'=>'striped bordered condensed',
	'htmlOptions' => array('style'=>'width:1100px'),
	'dataProvider'=>$model->search(),
	'filter'=>$model,	       
	'columns'=>array(
		//'pca_id',
		//'start_date',
		'number',
		'title',	
		 array(		'name'=>'partner',
  					'header'=>'Partner',
   					'value'=>'$data->partner->name',),
	
		 array(
                    'name'=>'assignedSectors',
					'type'=>'raw',
                    'value'=> '$data->getRelatedActivities($data->PcaSector, "name")'),
		 array(
                    'name'=>'assignedRRPs',
					'type'=>'raw',
                    'value'=> '$data->getRelatedActivities($data->PcaRrp5Output, "name")'),
		 array(
                    'name'=>'assignedCCCs',
					'type'=>'raw',
                    'value'=> '$data->getRelatedActivities($data->PcaTargetProgressRel, "name", array("tpTarget","tpTarget","goal"))'),
		 array(
                    'name'=>'assignedIndicators',
					'type'=>'raw',
                    'value'=> '$data->getRelatedActivities($data->PcaTargetProgressRel, "name", array("tpTarget","tpTarget"))'),
		 array(
                    'name'=>'assignedActivities',
					'type'=>'raw',
                    'value'=> '$data->getRelatedActivities($data->PcaActivity, "name")'),
		

		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
	
)); ?>

  <div>



  </div>

