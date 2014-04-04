<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<h2>Register New User</h2>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-Register-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
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
		
		<?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'email'); ?>
        
		<?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'username'); ?>
    
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password'); ?>
    
    	<?php echo $form->labelEx($model,'password2'); ?>
        <?php echo $form->passwordField($model,'password2',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password2'); ?>
        
        <div>
        	<?php echo CHtml::submitButton('Register', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
        </div>
    

		<?php $this->endWidget(); ?>
	</div>

    <p class="note" style="margin-top:248px; margin-left:300px;">Register with:</p>


</div><!-- form -->

<!--
<div class="row">
            <?php echo $form->labelEx($model,'isAdmin'); ?>
            <?php echo $form->textField($model,'isAdmin'); ?>
            <?php echo $form->error($model,'isAdmin'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'isProMentor'); ?>
            <?php echo $form->textField($model,'isProMentor'); ?>
            <?php echo $form->error($model,'isProMentor'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'isPerMentor'); ?>
            <?php echo $form->textField($model,'isPerMentor'); ?>
            <?php echo $form->error($model,'isPerMentor'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'isDomMentor'); ?>
            <?php echo $form->textField($model,'isDomMentor'); ?>
            <?php echo $form->error($model,'isDomMentor'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'isStudent'); ?>
            <?php echo $form->textField($model,'isStudent'); ?>
            <?php echo $form->error($model,'isStudent'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'isMentee'); ?>
            <?php echo $form->textField($model,'isMentee'); ?>
            <?php echo $form->error($model,'isMentee'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'isJudge'); ?>
            <?php echo $form->textField($model,'isJudge'); ?>
            <?php echo $form->error($model,'isJudge'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'isEmployer'); ?>
            <?php echo $form->textField($model,'isEmployer'); ?>
            <?php echo $form->error($model,'isEmployer'); ?>
        </div>
-->