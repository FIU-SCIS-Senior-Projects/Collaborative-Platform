<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
		'Invitations'=>array('admin'),
		'Create',
);

?>

<?php $form=$this->beginWidget('CActiveForm', array( 
    'id'=>'invitation-form', 
    'enableAjaxValidation'=>false, 
)); ?>

   <div class="row"> 
        <?php echo $form->labelEx($model,'message'); ?>
        <?php echo $form->textArea($model,'message',array('size'=>60,'maxlength'=>750, 'style'=>'width: 570px; height: 230px;')); ?>
        <?php echo $form->error($model,'message'); ?>
    </div> 
    
   <div class="row buttons"> 
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Send'); ?>
    </div> 

<?php $this->endWidget(); ?>