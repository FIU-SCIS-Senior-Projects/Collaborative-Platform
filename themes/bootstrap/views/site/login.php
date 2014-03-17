<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h2>Login</h2>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="regbox">
		<?php echo $form->textField($model,'username',array('placeholder'=>'User Name')); ?>
		<?php echo $form->error($model,'username'); ?></br>
	
		<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			<!--Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
		</p>
	
		<div class="row rememberMe">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>
		<a href= "/coplat/index.php/site/forgotPassword"> Forgot your Password? </a></br>		
		<div class="reg">
			<a href="<?php echo Yii::app()->baseUrl ?>/index.php/user/create" >Register</a>
		</div>
        
		<div style="float:left">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>'Login',
            )); ?>	
		</div></br>
        <!--
        <div class="row buttons">
			<?php echo CHtml::submitButton('Login',array("class"=>"btn btn-primary")); ?>
		</div>
        -->
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
