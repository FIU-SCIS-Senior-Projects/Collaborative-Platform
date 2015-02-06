<?php
/* @var $this ApplicationController */
/* @var $model Application */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'application-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
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
		<?php echo $form->textField($model,'system_pick_amount',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'system_pick_amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->