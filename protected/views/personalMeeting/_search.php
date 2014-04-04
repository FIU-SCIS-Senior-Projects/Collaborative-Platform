<?php
/* @var $this PersonalMeetingController */
/* @var $model PersonalMeeting */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mentee_user_id'); ?>
		<?php echo $form->textField($model,'mentee_user_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'personal_mentor_user_id'); ?>
		<?php echo $form->textField($model,'personal_mentor_user_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->