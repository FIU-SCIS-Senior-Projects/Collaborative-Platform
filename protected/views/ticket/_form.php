<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'creator_user_id'); ?>
		<?php echo $form->textField($model,'creator_user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'creator_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assign_user_id'); ?>
		<?php echo $form->textField($model,'assign_user_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'assign_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'domain_id'); ?>
		<?php echo $form->textField($model,'domain_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'domain_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->textField($model,'file',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->