<?php
/* @var $this ReassignRulesController */
/* @var $model ReassignRules */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reassign-rules-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rule'); ?>
		<?php echo $form->textField($model,'rule',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'rule'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'setting'); ?>
		<?php echo $form->textField($model,'setting'); ?>
		<?php echo $form->error($model,'setting'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->