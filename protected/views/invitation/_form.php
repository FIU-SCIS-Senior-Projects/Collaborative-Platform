<?php
/* @var $this InvitationController */
/* @var $model Invitation */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invitation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'administrator_user_id'); ?>
		<?php echo $form->textField($model,'administrator_user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'administrator_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->