<?php /* @var $this Controller */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/bootstrap/js/app/jquery.confirm.min.js');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/bootstrap/js/app/jquery-ui.js');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

 <?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'PCA Tool', 'url'=>array('/')),
		array('label'=>'Dashboard', 'url'=>array('/dashboard')),
		array('label'=>'Map', 'url'=>array('/dashboard#map')),
                //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                //array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
 )); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>
	<div id="footer">
	<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_US"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a><br />This work by <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.kosovoinnovations.org" property="cc:attributionName" rel="cc:attributionURL">Innovations Lab Kosovo</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_US">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.

	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
