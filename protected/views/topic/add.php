<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'topic-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div id="regbox">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
        
		<?php echo $form->labelEx($model,'domain_id'); ?>
		<?php echo $form->dropDownList($model,'description', CHtml::listData(Domain::model()->findAll(), 'id', 'name'));
		//echo $form->textField($model,'domain_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'domain_id'); ?>
        
    	<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('id'=>'theDescription', 'style'=>'width:631px', 'cols'=>100, 'rows'=>5,
                    'width'=>'691px','size'=>500,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>	    	
		</br>	
    	<?php echo CHtml::submitButton('Create', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->