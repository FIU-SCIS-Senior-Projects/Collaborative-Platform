<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>



<br><br><br><br><br><br>

<div class="form">

<div style="float:left; border:1px solid">
<?php $this->widget('bootstrap.widgets.TbCarousel', array(
    'items'=>array(
        array('image'=>'/coplat/images/mentor.png', 'label'=>'Collaborative Platform', 'caption'=>'Collaborative Platform is a space'),
    	/*array('image'=>'/JobFair/images/imgs/slider5.gif', 'label'=>'-Employers-', 'caption'=>'Recruiting is difficult and expensive, especially when you need to send personnel to the universities to find students. Virtual Job Fair allows you to virtually do this. With our Live Video Interview, your personnel can interview the candidates without leaving the office. '),
    	array('image'=>'/JobFair/images/imgs/slider.png', 'label'=>'-Students-', 'caption'=>'Need a job and do not know where to start? Well start here. Virtual Job Fair allows you to create a profile and showcase your skills and abilities for free. We also match you with current job opening based on your skills.'),*/
    		 
    		),
		'htmlOptions' => array('style'=>'width:600px;'),
)); ?>
</div>

<img style="float:left; height:50px; margin-left:50px"src='/coplat/images/mentor.png'/>
<h2 style="margin-bottom:40px;float:left;margin-left:10px">Collaborative Platform Login</h2>

<div id="login">	

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>



	<?php echo $form->textField($model,'username', array('placeholder'=>'User Name')); ?><br><br>
	<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
	<br>
	<br>
	<?php echo $form->checkBox($model,'rememberMe',array('style'=>'float:left')); ?>
	<p style="float:left; margin-left:5px">Remember Me</p>
	<br>
	<br>
	<div style="float:left">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Login',
        )); ?>
	
</div>
	<div style="float:left; margin-left: 10px;margin-top: -5px;">
	<a style="float:left;" href= "/coplat/index.php/site/forgotPassword" >  Forgot Password </a>	
	<div style="clear:both"></div>
	<a style="float:left;" href= "/coplat/index.php/user/register" > Register  </a>	
</div>


	
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<div id="altlogin" >
<p>Students may login with these:</p>

<a href="">
<a href="http://vjf-sp14.cs.fiu.edu/JobFair/index.php/profile/fiuCsSeniorAuth">
<img class="loginimg" src="/coplat/images/login/fiu_cs_login.png" style="margin: 1px" height="150" width="240">
</a><br>

<a href="http://vjf-sp14.cs.fiu.edu/JobFair/index.php/profile/fiuAuth">
<img class="loginimg" src="/coplat/images/login/fiu_login.png" style="margin: 1px" height="150" width="240">
</a><br>

<a href="http://vjf-sp14.cs.fiu.edu/JobFair/index.php/profile/googleAuth">
<img  class="loginimg" src="/coplat/images/login/google_login.png" style="margin: 1px" height="150" width="240">
</a><br>


<a href="http://vjf-sp14.cs.fiu.edu/JobFair/index.php/user/auth1">
<img class="loginimg" src="/coplat/images/login/linkedIn_login.png" style="margin: 1px" height="150" width="240">
</a>
</div>

