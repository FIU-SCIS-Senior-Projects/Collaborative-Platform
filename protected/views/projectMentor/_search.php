<?php
/* @var $this ProjectMentorController */
/* @var $model ProjectMentor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_hours'); ?>
		<?php echo $form->textField($model,'max_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_projects'); ?>
		<?php echo $form->textField($model,'max_projects'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->