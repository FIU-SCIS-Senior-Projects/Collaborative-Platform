<?php
/* @var $this DomainController */
/* @var $model Domain */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domain-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div id="regbox">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>500,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>
	
        <div>
            <?php echo CHtml::submitButton('Create', array("class"=>"btn btn-primary")); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->