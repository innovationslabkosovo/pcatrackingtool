<?php
/* @var $this PartnerOrganizationController */
/* @var $model PartnerOrganization */

$this->breadcrumbs=array(
	'Partner Organizations'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List PartnerOrganization', 'url'=>array('index')),
	array('label'=>'Create Partner Organization', 'url'=>array('create')),
	array('label'=>'Update Partner Organization', 'url'=>array('update', 'id'=>$model->partner_id)),
	array('label'=>'Delete Partner Organization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->partner_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Partner Organizations', 'url'=>array('admin')),
);
if (isset($_GET['errorMessage']))
{
	Yii::app()->user->setFlash('error', 'Partner Organization <strong>'.$model->name.'</strong> cannot be deleted due to the following dependecies: <br/><strong>'.$_GET['errorMessage'].'</strong>');
	 $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); 
	
}

?>

<h4>Partner Organization: <?php echo $model->name; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'partner_id',
		'name',
		'description',
		'contact_person',
		'email',
		'phone_number',
		array(
		   'name'=>'Villages',
		   'type'=>'html',
		   'value'=>$model->getRelatedActivities($model->tblLocations,'name')),
	),
)); ?>

<!-- <h4> This Partner Organization deals with the following activities:  -->
<?php
/*foreach ($model->tblActivities as $key => $value) {
	echo "<br>";
	echo CHtml::link($value['name'], array('/activity/view', 'id'=>$value['activity_id']));	
	echo "<br>";
}*/
?><!-- </h4> -->

<h4> <?php echo $model->name; ?> is/has implementing the following PCAs:</h4>
<table class='detail-view table table-striped table-bordered table-condensed'>

<tr>
<?php
foreach ($model->pca as $key => $value) {
	echo "<tr>";
	echo "<td>".CHtml::link($value['number'], array('/pca/view', 'id'=>$value['pca_id']))."</td>";	
	echo "</tr>";
}
?>
</tr>
</table>

  <div>
    <?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/excel37X35.png', array('submit' => array('partnerOrganization/generateExcel', 'id'=>$model->partner_id)));  ?>
  </div>
<br>