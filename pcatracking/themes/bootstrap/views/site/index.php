<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;


?>

<h2>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h2>
<br>

<?php 
echo '<hr>';
echo '<legend><h4>Programme Cooperation Agreements</h4></legend>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'View PCAs', 'buttonType' => 'link', 'url' => 'pca/admin')); echo '</span>'; 
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Add New PCA', 'buttonType' => 'link', 'url' => 'pca/create')); echo '</span>'; 
//echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Ammend PCAs', 'buttonType' => 'link', 'url' => 'pca/admin')); echo '</span>'; 
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Add New PCA Report', 'buttonType' => 'link', 'url' => 'pcaReport/create')); echo '</span>'; 
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'View PCA Reports', 'buttonType' => 'link', 'url' => 'pcaReport/admin')); echo '</span>'; 
echo '<br>';
echo '<br>';
echo '<hr>';

echo '<br>';
echo '<legend><h4>PCA Related RRP5 Outputs, Intermediate Results, WBS, CCC, Indicators, Units and Activities</h4></legend>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'Add New Intermediate Result', 'buttonType' => 'link', 'url' => 'intermediateResult/create')); echo '</span>'; 
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'View Intermediate Result', 'buttonType' => 'link', 'url' => 'intermediateResult/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'Add New WBS/Activity', 'buttonType' => 'link', 'url' => 'wbs/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'View WBS/Activity', 'buttonType' => 'link', 'url' => 'wbs/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'Add New RRP Output', 'buttonType' => 'link', 'url' => 'rrp5Output/create')); echo '</span>'; 
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'View RRP Outputs', 'buttonType' => 'link', 'url' => 'rrp5Output/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'Add New CCC', 'buttonType' => 'link', 'url' => 'goal/create')); echo '</span>'; 
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'View CCCs', 'buttonType' => 'link', 'url' => 'goal/admin')); echo '</span>'; 
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'Add New Indicator', 'buttonType' => 'link', 'url' => 'target/create')); echo '</span>'; 
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'View Indicators', 'buttonType' => 'link', 'url' => 'target/admin')); echo '</span>'; 
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'Add New Activity', 'buttonType' => 'link', 'url' => 'activity/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'View Activities', 'buttonType' => 'link', 'url' => 'activity/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'Add New Unit', 'buttonType' => 'link', 'url' => 'unit/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'action','label'=>'View Units', 'buttonType' => 'link', 'url' => 'unit/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<hr>';

echo '<br>';
echo '<legend><h4>Donors, Grants and Partners</h4></legend>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'success','label'=>'Add New Partner Organization', 'buttonType' => 'link', 'url' => 'partnerOrganization/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'success','label'=>'View Partner Organizations', 'buttonType' => 'link', 'url' => 'partnerOrganization/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'success','label'=>'Add New Donor', 'buttonType' => 'link', 'url' => 'donor/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'success','label'=>'View Donors', 'buttonType' => 'link', 'url' => 'donor/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'success','label'=>'Add New Grant', 'buttonType' => 'link', 'url' => 'grant/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'success','label'=>'View Grants', 'buttonType' => 'link', 'url' => 'grant/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<hr>';
?>


<?php
//display this section only if admin is logged in
if (Yii::app()->user->data()->superuser){
echo '<br>';
echo '<legend><h4>Admin Section</h4></legend>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'Add New Sector', 'buttonType' => 'link', 'url' => 'sector/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'View Sectors', 'buttonType' => 'link', 'url' => 'sector/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'Add New Gateway', 'buttonType' => 'link', 'url' => 'gateway/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'View Gateways', 'buttonType' => 'link', 'url' => 'gateway/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'Add New Governorate', 'buttonType' => 'link', 'url' => 'governorate/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'View Governorates', 'buttonType' => 'link', 'url' => 'governorate/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'Add New Kadaa', 'buttonType' => 'link', 'url' => 'region/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'View Kadaas', 'buttonType' => 'link', 'url' => 'region/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'Add New Locality', 'buttonType' => 'link', 'url' => 'locality/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'View Localities', 'buttonType' => 'link', 'url' => 'locality/admin')); echo '</span>';
echo '<br>';
echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'Add New Village', 'buttonType' => 'link', 'url' => 'location/create')); echo '</span>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'View Villages', 'buttonType' => 'link', 'url' => 'location/admin')); echo '</span>';
echo '<br>';
    echo '<br>';
echo '<span class="home_page_span">' ;$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'View PCA Change Log', 'buttonType' => 'link', 'url' => 'pcaUserAction/admin')); echo '</span>';
echo '<br>';
echo '<hr>';
}
?>
