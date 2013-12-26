<?php
/* @var $this PartnerOrganizationController */
/* @var $model PartnerOrganization */

$this->breadcrumbs=array(
	'Partner Organizations'=>array('index'),
	$model->name=>array('view','id'=>$model->partner_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List PartnerOrganization', 'url'=>array('index')),
	array('label'=>'Create Partner Organization', 'url'=>array('create')),
	array('label'=>'View Partner Organization', 'url'=>array('view', 'id'=>$model->partner_id)),
	array('label'=>'Manage Partner Organizations', 'url'=>array('admin')),
);
?>

<h4>Update <?php echo $model->name; ?> Partner Organization details</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model,'flag'=>$flag)); ?>