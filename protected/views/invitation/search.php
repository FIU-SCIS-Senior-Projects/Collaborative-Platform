<?php
/* @var $this InvitationController */
/* @var $model Invitation */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'administrator_user_id'); ?>
		<?php echo $form->textField($model,'administrator_user_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'administrator'); ?>
		<?php echo $form->textField($model,'administrator'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mentor'); ?>
		<?php echo $form->textField($model,'mentor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mentee'); ?>
		<?php echo $form->textField($model,'mentee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employer'); ?>
		<?php echo $form->textField($model,'employer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge'); ?>
		<?php echo $form->textField($model,'judge'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->