<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.jgrowl.css" />
	
	
    <link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
	<script src="http://vjs.zencdn.net/c/video.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->bootstrap->register();  ?>
	
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.jgrowl.js"></script>
	<link rel="shortcut icon" href="/coplat/images/ico/icon.ico">
</head>

<body>
<?php 
	$profile = '/profile/view';
?>
<?php 
	$this->widget('bootstrap.widgets.TbNavbar',array(
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.TbMenu',
				'items'=>array(
					//array('label'=>'Home', 'url'=>array('/site/index')),
					//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					//array('label'=>'Contact', 'url'=>array('/site/contact')),
					//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Message', 'url'=>array('/message'), 'visible'=>!Yii::app()->user->isGuest ),
					array('label'=>'Create Ticket', 'url'=>array('/ticket/create'), 'visible'=>!Yii::app()->user->isGuest )
				)
			),
			array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-left'),
            'items'=>array('-',
                array('label'=>'('.Yii::app()->user->name.')', 'url'=>'#', 'items'=>array(
					array('label'=>'My Profile', 'url'=>array($profile), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Change Password','visible'=>!Yii::app()->user->isGuest, 'url'=>'/JobFair/index.php/user/ChangePassword'),
				
	
					'----',
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
 					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Register', 'url'=>array('/user/create'), 'visible'=>Yii::app()->user->isGuest),
                )),
            ),
        ),
		)
	)); 
	?>
<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

</div><!-- page -->

</body>
	<div style="height:50px;"></div>
    <div style="position:fixed; text-align:center; width:100%; height:20px; background-color:white;border-top: 1px solid rgb(206, 206, 206); padding:5px; 		bottom:0px; ">
        <a target="blank" href="http://fiu.edu">Florida Interational University</a> | Collaborative Platform - Senior Project 2014
    </div>
</html>
