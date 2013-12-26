<?php
/* @var $this PcaUserActionController */
/* @var $model PcaUserAction */



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pca_user_action-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>View User Actions on PCAs</h1>



<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'pca_user_action-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        //'pca_user_action_id',

        array(
            'name'=>'user',
            'value'=>'$data->user->username',),
        'pca_number',
        'pca_title',
        'action',
        'datetime',

    ),
)); ?>
