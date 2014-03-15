<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-Register-form',
	'enableAjaxValidation'=>false,
)); ?>
	
    
	<p class="note">Fields with <span class="required">*</span> are required.</p>
    
	<div id="regbox">
        <?php echo $form->labelEx($model,'fname'); ?>
        <?php echo $form->textField($model,'fname',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'fname'); ?>
        
    	<?php echo $form->labelEx($model,'mname'); ?>
        <?php echo $form->textField($model,'mname',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'mname'); ?>
        
		<?php echo $form->labelEx($model,'lname'); ?>
        <?php echo $form->textField($model,'lname',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'lname'); ?>
        
		<?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'username'); ?>
        
		<?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password'); ?>
    
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'email'); ?>
                
        <div>
            <?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Submit' : 'Save'*/); ?>
        </div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->