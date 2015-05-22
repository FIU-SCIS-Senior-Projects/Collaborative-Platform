<?php /* @var $this Controller */ ?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="3x6lVAUscjm7TbgKuOnySVxqX0x9DTxQWmcxV9ljyHQ" />
    <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/ajhifddimkapgcifgcodmmfdlknahffk">
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.jgrowl.css"/>
    <link rel="stylesheet"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/fontawesome/css/font-awesome.min.css">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->bootstrap->register(); ?>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.jgrowl.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/table-fix-header.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui.min.js"></script>
    <link rel="shortcut icon" href="/coplat/images/ico/icon.ico">
</head>
<body>

<?php
$userinfo = "";
if (!Yii::app()->user->isGuest) {
    $userinfo = User::model()->findBySql("SELECT fname FROM user WHERE username=:user", array(':user' => Yii::app()->user->name)) . " " . User::model()->findBySql("SELECT lname FROM user WHERE username=:user", array(':user' => Yii::app()->user->name));
} else
    $userinfo = "(Guest)";

$cp = true;
if (Yii::app()->user->isGuest) {
    $cp = false;

}

// if (User::isCurrentUserMentee()) {
//     $cp = false;
// }



?>
<?php
$currentUserIsAdmin = User::isCurrentUserAdmin();
$currentUserIsGuest = Yii::app()->user->isGuest;

$this->widget('bootstrap.widgets.TbNavbar', array(
    'htmlOptions' => array('class' => 'myNavbar', 'style' => ''),
    'type' => 'null',
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'htmlOptions' => array('class' => 'pull-right'),
            'items' => array('-',
                array('label' => 'Home', 'url' => array('/'), 'visible' => !$currentUserIsGuest),           //Home menu
                array('label' => 'Mail', 'url' => array('/message'), 'visible' => !$currentUserIsGuest),    //Message menu
              
                array('label' => 'Reports', 'visible' => $currentUserIsAdmin,                                //Reports Root Menu
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array('-',
                        array('label' => 'Utilization Dashboard', 'visible'=> $currentUserIsAdmin,
                              'class' => 'bootstrap.widgets.TbMenu', 
                               'url' => array('/utilizationDashboard')), //Utilization dashboard

                        array('label' => 'Mentor', 'visible' => $currentUserIsAdmin,       //Mentor Report
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('/reportMentor'),
                        ),
                        array('label' => 'Mentee', 'visible' => $currentUserIsAdmin,        //Mentee Report
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('/reportMentee')
                        ),
                        array('label' => 'Ticket', 'visible' => $currentUserIsAdmin,        //Ticket Report
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('/reportTicket'),
                        ), 
                        array('label' => 'Frequent Mentee Sub-Domains', 'visible' => $currentUserIsAdmin,        //Ticket Report
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('/Analytics/PullFrecuentMenteeSubdomains'),
                        ),  

                    )),
                array('label' => 'Video Conf.', 'url' => array('/videoConference'), 'visible'=> !$currentUserIsGuest), //Utilization dashboard
                array('label' => 'Manage', 'visible' => !$currentUserIsGuest && $currentUserIsAdmin,         //Manage Root Menu
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array('-',
                        array('label' => 'Users', 'visible' => !$currentUserIsGuest,         //Manage Users
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('user/admin'),
                        ),
                        array('label' => 'Projects', 'visible' => !$currentUserIsGuest,      //Manage Projects
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('project/admin')
                        ),
                        array('label' => 'Domains', 'visible' => !$currentUserIsGuest,       //Manage Domains
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('domain/admin'),
                        ),
                        array('label' => 'Tickets', 'visible' => !$currentUserIsGuest,       //Manage Tickets
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('ticket/admin')
                        ),
                        array('label' => 'Invites', 'visible' => !$currentUserIsGuest,       //Manage Invitations
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('invitation/admin')

                        ),
                        array('label' => 'Applications', 'visible' => !$currentUserIsGuest,  //Manage applications
                            'class' => 'bootstrap.widgets.TbMenu',
                            'url' => array('application/admin')
                        ),
                    ),
                ),
                array('label' => 'Mentor Apply', 'url' => array('application/portal'), 'visible' => !$currentUserIsGuest), //Mentor Apply
                array('label' => 'Create Ticket', 'url' => array('/ticket/create'), 'visible' => !$currentUserIsGuest),  //Create Ticket
                array('label' => $userinfo, 'url' => '#', 'items' => array(                                             //User Info root menu
                    array('label' => 'My Profile', 'url' => array('profile/userProfile'), 'visible' => !$currentUserIsGuest),  //View Profile
                    array('label' => 'Change Password', 'visible' => $cp, 'url' => '/coplat/index.php/user/ChangePassword'),  //Change password
                    '----',
                    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !$currentUserIsGuest),  //Change logout
                    array('label' => 'Login', 'url' => array('/site/login'), 'visible' => $currentUserIsGuest),)),                               //Log in
                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                //array('label'=>'Contact', 'url'=>array('site/contact')),

            ),
        ),
    )
));
?>


<div class="container" id="page" style="margin-top: 60px">

    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'links' => $this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif ?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">

    </div>
    <!-- footer -->

</div>
<!-- page -->

</body>
<div style="height:50px;"></div>
<div
    style="position:fixed; text-align:center; width:100%; height:35px; background-color:white; border-top: 1px solid rgb(206, 206, 206); padding:5px; 		bottom:0px; ">
    <a target="blank" href="http://fiu.edu">Florida International University</a> | Collaborative Platform - Senior
    Project 2015
</div>
</html>
