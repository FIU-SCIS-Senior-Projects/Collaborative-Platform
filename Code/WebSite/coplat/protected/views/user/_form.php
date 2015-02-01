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
		<?php echo $form->labelEx($model,'university'); ?>
		<?php echo $form->textField($model,'university',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'university'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'isAdmin'); ?>
		<?php echo $form->textField($model,'isAdmin'); ?>
		<?php echo $form->error($model,'isAdmin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isProMentor'); ?>
		<?php echo $form->textField($model,'isProMentor'); ?>
		<?php echo $form->error($model,'isProMentor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isPerMentor'); ?>
		<?php echo $form->textField($model,'isPerMentor'); ?>
		<?php echo $form->error($model,'isPerMentor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isDomMentor'); ?>
		<?php echo $form->textField($model,'isDomMentor'); ?>
		<?php echo $form->error($model,'isDomMentor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isStudent'); ?>
		<?php echo $form->textField($model,'isStudent'); ?>
		<?php echo $form->error($model,'isStudent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isMentee'); ?>
		<?php echo $form->textField($model,'isMentee'); ?>
		<?php echo $form->error($model,'isMentee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isJudge'); ?>
		<?php echo $form->textField($model,'isJudge'); ?>
		<?php echo $form->error($model,'isJudge'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isEmployer'); ?>
		<?php echo $form->textField($model,'isEmployer'); ?>
		<?php echo $form->error($model,'isEmployer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isNew'); ?>
		<?php echo $form->textField($model,'isNew'); ?>
		<?php echo $form->error($model,'isNew'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->