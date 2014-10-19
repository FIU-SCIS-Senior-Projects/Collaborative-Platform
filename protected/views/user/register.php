<?php
/* @var $this UserController */
/* @var $model User */
/* @var $infoModel UserInfo */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('register', "
	$('.next').click(function(){
		$('.personal-info').toggle();
		$('.next').attr('disabled', 'disabled');
		return false;
	});
	
	$('.next2').click(function(){
		$('.skills-info').toggle();
		$('.next2').attr('disabled', 'disabled');
		return false;
	});
");
?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-Register-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	

	<?php echo $form->errorSummary($model); ?>
    
	<div id="regbox" class="account-info">
        <?php /* $this->widget('bootstrap.widgets.TbTabs', array(
		    'tabs'=> $this->getTabs($form, $model)
		)); */?>
		<h4>Account Info</h4>
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
        
        <?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'primary',
					'size'=>'large',
					'block'=>'true',
	                'label'=>'Next',
        			'htmlOptions'=>array('class'=>'next'),
	            )); ?>
    </div>
    <div id="regbox" class="personal-info" style="display:none">
    	<h4>Work Experience</h4>
        <?php echo $form->labelEx($infoModel,'employer'); ?>
        <?php echo $form->textField($infoModel,'employer',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($infoModel, 'employer'); ?>
        
        <?php echo $form->labelEx($infoModel,'position'); ?>
        <?php echo $form->textField($infoModel,'position',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($infoModel,'position'); ?>
         
        <?php echo $form->labelEx($infoModel,'job_start'); ?>
        <?php echo $form->textField($infoModel,'job_start',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($infoModel,'job_start'); ?>
		
		<h4>Education</h4>
		<?php $data = array('Select', 'Bachelors', 'Masters', 'PhD')?>
        <?php echo $form->dropDownListRow($infoModel,'degree',array_combine($data, $data)); ?>
		<?php echo $form->error($infoModel,'degree'); ?>
		
		<?php echo $form->labelEx($infoModel,'field_of_study'); ?>
        <?php echo $form->textField($infoModel,'field_of_study',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($infoModel, 'field_of_study'); ?>
		
		<?php echo $form->labelEx($infoModel,'university'); ?>
        <?php echo $form->textField($infoModel,'university',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($infoModel,'university'); ?>
		
		<?php echo $form->labelEx($infoModel,'grad_year'); ?>
        <?php echo $form->textField($infoModel,'grad_year',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($infoModel,'grad_year'); ?>
		
		<?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'primary',
					'size'=>'large',
					'block'=>'true',
	                'label'=>'Next',
        			'htmlOptions'=>array('class'=>'next2'),
	            )); ?>
	</div>
	<div id="regbox" class="skills-info" style="display:none">
		<h4>Skills</h4>
        <?php echo $form->textField($model,'skills',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'skills'); ?>
		<br></br>
		<?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-primary btn-block")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
	</div>
        
	<?php $this->endWidget(); ?>