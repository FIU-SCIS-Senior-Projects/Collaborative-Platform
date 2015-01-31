<?php
/* @var $this ApplicationRecommendedDomainController */
/* @var $model ApplicationRecommendedDomain */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'application-recommended-domain-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'appId'); ?>
		<?php echo $form->textField($model,'appId',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'appId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'domain'); ?>
		<?php echo $form->textField($model,'domain',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'domain'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subdomain'); ?>
		<?php echo $form->textField($model,'subdomain',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'subdomain'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proficiency'); ?>
		<?php echo $form->textField($model,'proficiency',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'proficiency'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->