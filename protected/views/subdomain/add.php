<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subdomain-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div id="regbox">
        <?php echo $form->labelEx($model,'domain_id'); ?>
        <?php echo $form->dropDownList($model, 'domain_id', CHtml::listData(Domain::model()->findAll(array('order'=>'name')), 'id', 'name')); ?>
        <?php echo $form->error($model,'domain_id'); ?>

		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>

		<?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('id'=>'theDescription', 'style'=>'width:631px', 'cols'=>100, 'rows'=>5,
            'width'=>'691px','size'=>500,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'description'); ?>

		<?php echo $form->labelEx($model,'validator'); ?>
		<?php echo $form->dropDownList($model,'validator', array(1,2,3,4,5,6,7,8,9,10), array()); ?>
		<?php echo $form->error($model,'validator'); ?>
        
        <?php echo $form->labelEx($model,'need'); ?>
		<?php echo $form->dropDownList($model,'validator', array("High", "Medium", "Low"), array()); ?>
        <?php echo $form->error($model,'need'); ?>

		<?php echo $form->labelEx($model,'need_amount'); ?>
		<?php echo $form->textField($model,'need_amount'); ?>
		<?php echo $form->error($model,'need_amount'); ?>
        <br/>

		<?php echo CHtml::submitButton('Create',  array("class"=>"btn btn-primary")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->