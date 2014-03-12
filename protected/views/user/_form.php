<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mname'); ?>
		<?php echo $form->textField($model,'mname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pic_url'); ?>
		<?php echo $form->textField($model,'pic_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pic_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activated'); ?>
		<?php echo $form->textField($model,'activated'); ?>
		<?php echo $form->error($model,'activated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activation_chain'); ?>
		<?php echo $form->textField($model,'activation_chain',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'activation_chain'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disable'); ?>
		<?php echo $form->textField($model,'disable'); ?>
		<?php echo $form->error($model,'disable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'biography'); ?>
		<?php echo $form->textField($model,'biography',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'biography'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'linkedin_id'); ?>
		<?php echo $form->textField($model,'linkedin_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'linkedin_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fiucs_id'); ?>
		<?php echo $form->textField($model,'fiucs_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'fiucs_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_id'); ?>
		<?php echo $form->textField($model,'google_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'google_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->