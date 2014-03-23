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

<h2>Forgot your Password?</h2>

<?php if ($error != '') {?>
	<p style="color:red;"> <?php echo $error?></p>
	<?php }?>


<div class="form">
<p>Please enter your email:</p>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div id="regbox">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
     	<div>
			<?php echo CHtml::submitButton('Send Password', array("class"=>"btn btn-primary")); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

