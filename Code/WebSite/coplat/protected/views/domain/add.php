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

	<?php //echo $form->errorSummary($model); ?>

	<div id="regbox">
		<?php
            echo $form->labelEx($model,'name');
		    echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45));
		    echo $form->error($model,'name');
        ?>

		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('id'=>'theDescription', 'style'=>'width:631px', 'cols'=>100, 'rows'=>5,
            'width'=>'691px','size'=>500,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>

        <?php echo $form->labelEx($model,'validator'); ?>
        <?php echo $form->numberField($model, 'validator', array('max'=> 10, 'min' => 1)); ?>
        <?php echo $form->error($model,'validator');
        ?>
        <br/>

        <?php echo CHtml::submitButton('Create', array("class"=>"btn btn-primary")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->