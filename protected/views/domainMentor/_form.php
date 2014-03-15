<?php
/* @var $this DomainMentorController */
/* @var $model DomainMentor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domain-mentor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_role_user_id'); ?>
		<?php echo $form->textField($model,'user_role_user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'user_role_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_role_role_id'); ?>
		<?php echo $form->textField($model,'user_role_role_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'user_role_role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_tickets'); ?>
		<?php echo $form->textField($model,'max_tickets'); ?>
		<?php echo $form->error($model,'max_tickets'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->