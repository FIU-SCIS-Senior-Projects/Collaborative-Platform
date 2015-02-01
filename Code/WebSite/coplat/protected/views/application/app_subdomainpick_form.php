<?php
/* @var $form CActiveForm */
?>

<div class="form"> 

<?php $form=$this->beginWidget('CActiveForm', array( 
    'id'=>'application-subdomain-mentor-pick-form', 
    'enableAjaxValidation'=>false, 
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p> 

    <?php echo $form->errorSummary($model); ?>

    <div class="row"> 
        <?php echo $form->labelEx($model,'subdomain_id'); ?>
        <?php echo $form->textField($model,'subdomain_id',array('size'=>11,'maxlength'=>11)); ?>
        <?php echo $form->error($model,'subdomain_id'); ?>
    </div>

    <div class="row"> 
        <?php echo $form->labelEx($model,'proficiency'); ?>
        <?php echo $form->textField($model,'proficiency'); ?>
        <?php echo $form->error($model,'proficiency'); ?>
    </div>

    <div class="row buttons"> 
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- form -->