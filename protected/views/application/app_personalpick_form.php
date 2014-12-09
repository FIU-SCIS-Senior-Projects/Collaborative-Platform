<?php
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'application-personal-mentor-pick-form',
		'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p> 

    <?php echo $form->errorSummary($model); ?>

    <div class="row"> 
        <?php echo $form->labelEx($model,'app_id'); ?>
        <?php echo $form->textField($model,'app_id',array('size'=>11,'maxlength'=>11)); ?>
        <?php echo $form->error($model,'app_id'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
        <?php echo $form->error($model,'user_id'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'approval_status'); ?>
        <?php echo $form->textField($model,'approval_status',array('size'=>18,'maxlength'=>18)); ?>
        <?php echo $form->error($model,'approval_status'); ?>
    </div> 

    <div class="row buttons"> 
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- form -->