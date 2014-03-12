<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - ForgotPassword';
$this->breadcrumbs=array(
	'Login',
);
$model = new User;
?>

<h1>Forgot your Password?</h1>

<?php if ($error != '') {?>
	<p style="color:red;"> <?php echo $error?></p>
	<?php }?>

<p>Please enter your email:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Send Password', array("class"=>"btn btn-primary")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

