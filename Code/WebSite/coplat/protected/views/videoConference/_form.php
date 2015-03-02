<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'video-conference-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'moderator_id'); ?>
		<?php echo $form->textField($model,'moderator_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'moderator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scheduled_on'); ?>
		<?php echo $form->textField($model,'scheduled_on'); ?>
		<?php echo $form->error($model,'scheduled_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scheduled_for'); ?>
		<?php echo $form->textField($model,'scheduled_for'); ?>
		<?php echo $form->error($model,'scheduled_for'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

    <div class="row">
        <label for="invitee-1">Invitee</label>
        <input type="email" class="form-control" id="invitee-1" placeholder="invitee email">
    </div>

    <div class="row">
        <label for="invitee-1">Invitee</label>
        <input type="email" class="form-control" id="invitee-2" placeholder="invitee email">
    </div>

    <div class="row">
        <label for="invitee-1">Invitee</label>
        <input type="email" class="form-control" id="invitee-3" placeholder="invitee email">
    </div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->