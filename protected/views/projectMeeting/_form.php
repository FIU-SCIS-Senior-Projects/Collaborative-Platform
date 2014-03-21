<?php
/* @var $this ProjectMeetingController */
/* @var $model ProjectMeeting */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-meeting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'project_mentor_user_id'); ?>
		<?php echo $form->textField($model,'project_mentor_user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'project_mentor_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mentee_user_id'); ?>
		<?php echo $form->textField($model,'mentee_user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'mentee_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->