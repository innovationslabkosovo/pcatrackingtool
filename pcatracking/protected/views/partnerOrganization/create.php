<?php
/* @var $this PartnerOrganizationController */
/* @var $model PartnerOrganization */

$this->breadcrumbs=array(
	'Partner Organizations'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List PartnerOrganization', 'url'=>array('index')),
	array('label'=>'Manage Partner Organizations', 'url'=>array('admin')),
);
?>

<h1>Create Partner Organization</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
