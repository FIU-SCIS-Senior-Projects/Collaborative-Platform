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
	$profile = '/profile/view';
	//var_dump(!Yii::app()->user->isGuest && !User::isCurrentUserAdmin(Yii::app()->user->name));
	//exit;
?>
<?php 
	$this->widget('bootstrap.widgets.TbNavbar',array(
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.TbMenu',
				'items'=>array(
					/*array('label'=>'Home','visible'=>!Yii::app()->user->isGuest,
					'class'=>'bootstrap.widgets.TbMenu',
					'htmlOptions'=>array('class'=>'pull-left'),
					'items'=>array('-',
									array('label'=>'Administrator', 'url'=>array('home/adminHome'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserAdmin(Yii::app()->user->name)),
									array('label'=>'Project Mentor', 'url'=>array('home/pMentorHome'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserProMentor(Yii::app()->user->name)),
									array('label'=>'Personal Mentor', 'url'=>array('home/ppMentorHome'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserPerMentor(Yii::app()->user->name)),
									array('label'=>'Domain Mentor', 'url'=>array('home/dMentorHome'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserDomMentor(Yii::app()->user->name)),
									array('label'=>'Mentee', 'url'=>array('home/menteeHome'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserMentee(Yii::app()->user->name)),
									array('label'=>'Employer', 'url'=>array('personalmentor/admin'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserEmployer(Yii::app()->user->name)),
									array('label'=>'Judge', 'url'=>array('personalmentor/admin'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserJudge(Yii::app()->user->name)),
									
							),
					),*/

                    //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					//array('label'=>'Contact', 'url'=>array('/site/contact')),
					array('label'=>'Mail', 'url'=>array('/message'), 'visible'=>!Yii::app()->user->isGuest ),

					/*array('label'=>'Meeting','visible'=>!Yii::app()->user->isGuest && (User::isCurrentUserDomMentor(Yii::app()->user->name)|| User::isCurrentUserPerMentor(Yii::app()->user->name)),
					'class'=>'bootstrap.widgets.TbMenu',
					'htmlOptions'=>array('class'=>'pull-left'),
					'items'=>array('-',
									array('label'=>'Project Mentor','visible'=>!Yii::app()->user->isGuest && User::isCurrentUserProMentor(Yii::app()->user->name),
									'class'=>'bootstrap.widgets.TbMenu',
									'htmlOptions'=>array('class'=>'pull-left'),
									'items'=>array(array('label'=>'Manage Meetings', 'url'=>array('projectMeeting/admin'), 'visible'=>!Yii::app()->user->isGuest),
													array('label'=>'Create Meeting', 'url'=>array('projectMeeting/create'), 'visible'=>!Yii::app()->user->isGuest),
													
											),
									),
									array('label'=>'Personal Mentor','visible'=>!Yii::app()->user->isGuest && User::isCurrentUserPerMentor(Yii::app()->user->name),
									'class'=>'bootstrap.widgets.TbMenu',
									'htmlOptions'=>array('class'=>'pull-left'),
									'items'=>array(array('label'=>'Manage Meetings', 'url'=>array('personalMeeting/admin'), 'visible'=>!Yii::app()->user->isGuest),
													array('label'=>'Create Meetings', 'url'=>array('personalMeeting/create'), 'visible'=>!Yii::app()->user->isGuest),
													
											),
									),
									array('label'=>'Mentee','visible'=>!Yii::app()->user->isGuest && User::isCurrentUserMentee(Yii::app()->user->name),
									'class'=>'bootstrap.widgets.TbMenu',
									'htmlOptions'=>array('class'=>'pull-left'),
									'items'=>array(array('label'=>'Manage Meetings','visible'=>!Yii::app()->user->isGuest,
														'class'=>'bootstrap.widgets.TbMenu',
														'htmlOptions'=>array('class'=>'pull-left'),
														'items'=>array(array('label'=>'Personal Meetings', 'url'=>array('personalMeeting/admin'), 'visible'=>!Yii::app()->user->isGuest),
																		array('label'=>'Project Meetings', 'url'=>array('projectMeeting/admin'), 'visible'=>!Yii::app()->user->isGuest),
																		
																),
														),
													array('label'=>'Create Meetings','visible'=>!Yii::app()->user->isGuest && User::isCurrentUserPerMentor(Yii::app()->user->name),
														'class'=>'bootstrap.widgets.TbMenu',
														'htmlOptions'=>array('class'=>'pull-left'),
														'items'=>array(array('label'=>'Personal Meetings', 'url'=>array('personalMeeting/create'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserAdmin(Yii::app()->user->name)),
																		array('label'=>'Project Meetings', 'url'=>array('projectMeeting/create'), 'visible'=>!Yii::app()->user->isGuest && User::isCurrentUserAdmin(Yii::app()->user->name)),
																		
																),
														),
													
											),
									),
							),
					),*/
					
					//array('label'=>'Manage','visible'=>!Yii::app()->user->isGuest && User::isCurrentUserAdmin(Yii::app()->user->name),
					//'class'=>'bootstrap.widgets.TbMenu',
					//'htmlOptions'=>array('class'=>'pull-left'),
					//'items'=>array('-',
						//			array('label'=>'User','visible'=>!Yii::app()->user->isGuest /*& !User::isCurrentUserAdmin(Yii::app()->user->name)*/,
						//			'class'=>'bootstrap.widgets.TbMenu',
						//			'htmlOptions'=>array('class'=>'pull-left'),
							//		'items'=>array(array('label'=>'Manage', 'url'=>array('user/admin'), 'visible'=>!Yii::app()->user->isGuest /*& !User::isCurrentUserAdmin(Yii::app()->user->name)*/),
							//						array('label'=>'Add Administrator', 'url'=>array('user/create_admin'), 'visible'=>!Yii::app()->user->isGuest /*& !User::isCurrentUserAdmin(Yii::app()->user->name)*/),
													
							//				),
							//		),
							//		array('label'=>'Domain','visible'=>!Yii::app()->user->isGuest /*& !User::isCurrentUserAdmin(Yii::app()->user->name)*/,
							//		'class'=>'bootstrap.widgets.TbMenu',
							//		'htmlOptions'=>array('class'=>'pull-left'),
							//		'items'=>array(array('label'=>'Manage', 'url'=>array('domain/admin'), 'visible'=>!Yii::app()->user->isGuest /*& !User::isCurrentUserAdmin(Yii::app()->user->name)*/),
								//					array('label'=>'Create', 'url'=>array('domain/create'), 'visible'=>!Yii::app()->user->isGuest /*& !User::isCurrentUserAdmin(Yii::app()->user->name)*/),
													
							//				),
							//		),
									
						//	),
					//),

                   // array('label'=>'New Ticket', 'url'=>array('/ticket/create'), 'visible'=>!Yii::app()->user->isGuest ),

                )
			),
			
			array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array('-',
						//array('label'=> '('.Yii::app()->user->name.')', 'url'=>'#', 'items'=>array(
                          array('label'=>  User::model()->findBySql("SELECT fname FROM user WHERE username=:user", array(':user'=> Yii::app()->user->name)).' '.
                                          User::model()->findBySql("SELECT lname FROM user WHERE username=:user", array(':user'=> Yii::app()->user->name)), 'url'=>'#', 'items'=>array(
							array('label'=>'My Profile', 'url'=>array('profile/userProfile'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Change Password','visible'=>!Yii::app()->user->isGuest, 'url'=>'/coplat/index.php/user/ChangePassword'),
						
			
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


<div class="container" id="page" style="margin-top: 60px">

	<?php /*if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		));*/ ?><!-- breadcrumbs -->
	<?php /*endif*/?>

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
