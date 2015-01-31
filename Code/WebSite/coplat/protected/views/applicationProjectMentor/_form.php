<?php
/* @var $this ApplicationProjectMentorController */
/* @var $model ApplicationProjectMentor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'application-project-mentor-form',
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
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_amount'); ?>
		<?php echo $form->textField($model,'max_amount',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'max_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_hours'); ?>
		<?php echo $form->textField($model,'max_hours',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'max_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'system_pick_amount'); ?>
		<?php echo $form->textField($model,'system_pick_amount',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'system_pick_amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->