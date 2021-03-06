<?php
/* @var $this PersonalMentorController */
/* @var $model PersonalMentor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personal-mentor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_hours'); ?>
		<?php echo $form->textField($model,'max_hours',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'max_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_mentees'); ?>
		<?php echo $form->textField($model,'max_mentees',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'max_mentees'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->