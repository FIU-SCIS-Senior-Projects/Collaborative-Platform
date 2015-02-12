<?php
/* @var $this DomainController */
/* @var $model Domain */
/* @var $form CActiveForm */
?>

<div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domain-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validator'); ?>
		<?php echo $form->textField($model,'validator'); ?>
		<?php echo $form->error($model,'validator'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'need'); ?>
		<?php echo $form->textField($model,'need',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'need'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'need_amount'); ?>
		<?php echo $form->textField($model,'need_amount'); ?>
		<?php echo $form->error($model,'need_amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->