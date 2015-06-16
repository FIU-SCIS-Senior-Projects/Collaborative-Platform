<?php
/* @var $this ReassignRulesController */
/* @var $model ReassignRules */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rule_id'); ?>
		<?php echo $form->textField($model,'rule_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rule'); ?>
		<?php echo $form->textField($model,'rule',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'setting'); ?>
		<?php echo $form->textField($model,'setting'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->