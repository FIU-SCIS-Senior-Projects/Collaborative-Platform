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
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/table-fix-header.js"></script>
	<link rel="shortcut icon" href="/coplat/images/ico/icon.ico">
</head>
<body>

<?php
    $userinfo = "";
    if(!Yii::app()->user->isGuest)
    {
        $userinfo = User::model()->findBySql("SELECT fname FROM user WHERE username=:user", array(':user'=> Yii::app()->user->name))." ".User::model()->findBySql("SELECT lname FROM user WHERE username=:user", array(':user'=> Yii::app()->user->name));
    }
    else
        $userinfo = "(Guest)";

$cp=true;
if(Yii::app()->user->isGuest)
{
    $cp = false;

}

if( User::isCurrentUserMentee())
{
    $cp = false;
}



?>
<?php 
    $currentUserIsAdmin = User::isCurrentUserAdmin();
	$currentUserIsGuest = Yii::app()->user->isGuest;
    
	$this->widget('bootstrap.widgets.TbNavbar',array(
        'htmlOptions'=>array('class'=>'myNavbar','style'=>''),
        'type'=>'null',
        'items'=>array(
            array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array('-',
            				array('label'=>'Home', 'url'=>array('/'), 'visible'=>!$currentUserIsGuest ),           //Home menu
							array('label'=>'Mail', 'url'=>array('/message'), 'visible'=>!$currentUserIsGuest ),    //Message menu
							array('label'=>'Reports','visible'=>$currentUserIsAdmin,                               //Reports Root Menu
							                        'class'=>'bootstrap.widgets.TbMenu',
									'items'=>array('-',
													array('label'=>'Mentor','visible'=>$currentUserIsAdmin,       //Mentor Report
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('/reportMentor'),	
													),
													array('label'=>'Mentee','visible'=>$currentUserIsAdmin,        //Mentee Report
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('/reportMentee')
													),
													array('label'=>'Ticket','visible'=>$currentUserIsAdmin,        //Ticket Report
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('/reportTicket'),
													),
											
									)),
							array('label'=>'Manage','visible'=>!$currentUserIsGuest && $currentUserIsAdmin,         //Manage Root Menu
									                'class'=>'bootstrap.widgets.TbMenu',
									'items'=>array('-',
													array('label'=>'Users','visible'=>!$currentUserIsGuest,         //Manage Users
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('user/admin'),
													),
													array('label'=>'Projects','visible'=>!$currentUserIsGuest,      //Manage Projects
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('project/admin')
													),	
													array('label'=>'Domains','visible'=>!$currentUserIsGuest,       //Manage Domains
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('domain/admin'),
													),												
													array('label'=>'Tickets','visible'=>!$currentUserIsGuest,       //Manage Tickets
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('ticket/admin')									
													),
													array('label'=>'Invites','visible'=>!$currentUserIsGuest,       //Manage Invitations
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('invitation/admin')
																
													),												
													array('label'=>'Applications','visible'=>!$currentUserIsGuest,  //Manage applications
															'class'=>'bootstrap.widgets.TbMenu',
															'url'=>array('application/admin')
													),
									),
							),
							array('label'=>'Mentor Apply', 'url'=>array('application/portal'),'visible'=>!$currentUserIsGuest), //Mentor Apply
                            array('label'=>'Create Ticket', 'url'=>array('/ticket/create'), 'visible'=>!$currentUserIsGuest ),  //Create Ticket
                            array('label'=>  $userinfo, 'url'=>'#', 'items'=>array(                                             //User Info root menu
								array('label'=>'My Profile', 'url'=>array('profile/userProfile'), 'visible'=>!$currentUserIsGuest),  //View Profile
								array('label'=>'Change Password','visible'=>  $cp, 'url'=>'/coplat/index.php/user/ChangePassword'),  //Change password
			  		            '----',
								array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!$currentUserIsGuest),  //Change logout
								array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>$currentUserIsGuest),)),                               //Log in
                            array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                            //array('label'=>'Contact', 'url'=>array('site/contact')),

            	),
			),
		)
	)); 
	?>


<div class="container" id="page" style="margin-top: 60px">

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
    <div style="position:fixed; text-align:center; width:100%; height:20px; background-color:white; border-top: 1px solid rgb(206, 206, 206); padding:5px; 		bottom:0px; ">
        <a target="blank" href="http://fiu.edu">Florida Interational University</a> | Collaborative Platform - Senior Project 2014
    </div>
</html>
