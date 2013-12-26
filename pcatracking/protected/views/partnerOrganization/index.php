<?php
/* @var $this PartnerOrganizationController */
/* @var $dataProvider CActiveDataProvider */
$this->redirect(array("partnerOrganization/admin"));
$this->breadcrumbs=array(
	'Partner Organizations',
);

$this->menu=array(
	array('label'=>'Create Partner Organization', 'url'=>array('create')),
	array('label'=>'Manage Partner Organizations', 'url'=>array('admin')),
);
?>

<h1>Partner Organizations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
