<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />    
	<!-- blueprint CSS framework -->
    
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

        <!--<div id="mainmenu">-->
            <?php  //echo (Yii::app()->user->isGuest)?"ok guest":"oh !! ".Yii::app()->user->name; ?>
            
        <!--</div>-->
	<div id="mainmenu">            
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>$this->getCustomMenu()
                             /*   'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
                                array('label'=>'Manage User', 'url'=>array('/manage/index')),
                                array('label'=>'Manage Menu', 'url'=>array('/managemenu/index')),
				array('label'=>'myLogin', 'url'=>array('/site/mylogin'), 'visible'=>Yii::app()->user->isGuest),                                
                                array('label'=>'myLogout ('.Yii::app()->user->name.')', 'url'=>array('/site/mylogout'), 'visible'=>!Yii::app()->user->isGuest),
                                //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                ),        */
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
<div id="data">    
    <?php 
        //Yii::app()->user->setState('var','Initail');
        if(Yii::app()->user->__isset('var'))    
            $myValue = Yii::app()->user->getState('var');            
        else
            $myValue = "<h4>". $this->id . "/" . $this->action->id . "</h4>";
        $this->renderPartial('/layouts/_ajaxContent', array('myValue'=>$myValue));     
    ?>
</div> 
</body>
</html>
<?php Yii::app()->dynamicRes->saveScheme(); // use This function on end of layout or use on afterRender of your Controller Class (Auto SaveScheme) ?>
