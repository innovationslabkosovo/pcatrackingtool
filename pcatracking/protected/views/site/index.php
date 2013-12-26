<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<br>
<br>
<?php 
echo '<hr>';
echo '<legend><h2>Programme Cooperation Agreements</h2></legend>';
echo '<br>';
echo CHtml::button('View PCAs', array('submit' => array('pca/admin'))); 
echo CHtml::button('Add New PCA', array('submit' => array('pca/create'))); 
echo CHtml::button('Ammend PCAs', array('submit' => array('pca/admin'))); 
echo '<br>';
echo '<br>';
echo CHtml::button('Add New PCA Report', array('submit' => array('pcaReport/create'))); 
echo CHtml::button('View PCA Reports', array('submit' => array('pcaReport/admin'))); 
echo '<br>';
echo '<br>';
echo '<hr>';

echo '<br>';
echo '<legend><h2>PCA Related RRP, Intermediate Results, WBS, CCC, Indicator and Activities</h2></legend>';
echo '<br>';
echo CHtml::button('Add New Intermediate Result', array('submit' => array('intermediateResult/create'))); 
echo CHtml::button('View Intermediate Result', array('submit' => array('intermediateResult/admin')));
echo '<br>';
echo '<br>';
echo CHtml::button('Add New WBS', array('submit' => array('wbs/create'))); 
echo CHtml::button('View WBS', array('submit' => array('wbs/admin')));
echo '<br>';
echo '<br>';
echo CHtml::button('Add New RRP Output', array('submit' => array('rrp5Output/create'))); 
echo CHtml::button('View RRP Outputs', array('submit' => array('rrp5Output/admin')));
echo '<br>';
echo '<br>';
echo CHtml::button('Add New CCC', array('submit' => array('goal/create'))); 
echo CHtml::button('View CCCs', array('submit' => array('goal/admin'))); 
echo '<br>';
echo '<br>';
echo CHtml::button('Add New Indicator', array('submit' => array('target/create'))); 
echo CHtml::button('View Indicators', array('submit' => array('target/admin'))); 
echo '<br>';
echo '<br>';
echo CHtml::button('Add New Activity', array('submit' => array('activity/create')));
echo CHtml::button('View Activities', array('submit' => array('activity/admin')));
echo '<br>';
echo '<br>';
echo '<hr>';

echo '<br>';
echo '<legend><h2>PCA Partners and Locations</h2></legend>';
echo '<br>';
echo CHtml::button('Add New Partner Organization', array('submit' => array('partnerOrganization/create')));
echo CHtml::button('View Partner Organizations', array('submit' => array('partnerOrganization/admin')));
echo '<br>';
echo '<br>';
echo CHtml::button('Add New Location', array('submit' => array('location/create')));
echo CHtml::button('View Locations', array('submit' => array('location/admin')));
echo '<br>';
echo '<br>';
echo '<hr>';
?>


<?php
//display this section only if admin is logged in
$username = Yii::app()->user->data()->username;
if (strcmp($username, "admin") == 0){
echo '<br>';
echo '<legend><h2>Admin Section</h2></legend>';
echo '<br>';
echo '<br>';
echo CHtml::button('Add New Sector', array('submit' => array('sector/create')));
echo '<br>';
echo '<br>';
echo CHtml::button('Add New Gateway', array('submit' => array('gateway/create')));
echo CHtml::button('View Gateways', array('submit' => array('gateway/admin')));
echo '<br>';
echo '<br>';
echo CHtml::button('Add New Governorate', array('submit' => array('governorate/create')));
echo CHtml::button('View Governorates', array('submit' => array('governorate/admin')));
echo '<br>';
echo '<br>';
echo CHtml::button('Add New Kadaa', array('submit' => array('region/create')));
echo CHtml::button('View Kadaas', array('submit' => array('region/admin')));
echo '<br>';
echo '<br>';
echo '<hr>';
}
?>

