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
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->dropDownList($model,'user_id', array("1002"=>"Jonathan Sanchez", "1003"=>"Nicholas Madariaga", "1004"=>"Masoud Sadjadi"), array('prompt'=>'Select location')); ?>
        <?php echo $form->error($model,'user_id'); ?>
    </div>  

    <div class="row buttons"> 
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- form -->