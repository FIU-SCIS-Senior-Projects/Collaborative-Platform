<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />


<h2>Collaborative Platform Registration</h2>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-Register-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php /*echo $form->errorSummary($model);*/ ?>
    
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
       
	</div>
    
    <div id="regbox1" style="margin-left:300px; width:220px!important">
    		<?php 
				echo $form->labelEx($model,'men_role');
				echo $form->checkBox($model,'isProMentor',array('style'=>'float:left'));
			?>
			<p style="float:left; margin-left:5px">Project Mentor</p></br></br>
			<?php 
				echo $form->checkBox($model,'isPerMentor',array('style'=>'float:left'));
			?>
			<p style="float:left; margin-left:5px">Personal Mentor</p></br></br>
			<?php 
				echo $form->checkBox($model,'isDomMentor',array('style'=>'float:left'));
			?>
			<p style="float:left; margin-left:5px">Domain Mentor</p></br></br>
			<?php 
				echo $form->checkBox($model,'isMentee',array('style'=>'float:left'));
			?>
			<p style="float:left; margin-left:5px">Mentee</p></br></br>
			
    </div>
    <div id="regbox1" style="margin-left:300px; width:220px!important">
		<?php 
            echo $form->labelEx($model,'vjf_role');
            echo $form->radioButtonList($model, 'vjf_role', array('Employer'=>'Employer', 'Student'=>'Student'), 
															array('onchange' => 'menuTypeChange(this.value);'));
			echo $form->error($model,'vjf_role'); 
        ?>			
    </div>
    <div id="regbox1" style="margin-left:300px; width:220px!important">
    		<?php 
				echo $form->labelEx($model,'rmj_role');
				echo $form->checkBox($model,'isJudge',array('style'=>'float:left'));
			?>
			<p style="float:left; margin-left:5px">Judge</p></br></br>
			<?php 
				echo $form->checkBox($model,'isStudent',array('style'=>'float:left'));
			?>
			<p style="float:left; margin-left:5px">Student</p></br></br>
			
    </div>
    <div style="margin-left:300px">
   		<?php echo CHtml::submitButton('Register', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
   	</div>
     	
    <?php $this->endWidget(); ?>  
    <div style="clear:both"></div>
	<br>
    <!--	
  <table class="table">
    	<tr>
        	<td>
            	<p class="note" >Mentoring Platform Roles:</p>
            	<div class="row rememberMe">
					<?php echo $form->checkBox($model,'isProMentor'); ?>
                    <?php echo $form->label($model,'isProMentor'); ?>
                    <?php echo $form->error($model,'isProMentor'); ?>
                </div>
                <div class="row rememberMe">
                    <?php echo $form->checkBox($model,'isPerMentor'); ?>
                    <?php echo $form->label($model,'isPerMentor'); ?>
                    <?php echo $form->error($model,'isPerMentor'); ?>
                </div>
                <div class="row rememberMe">
                    <?php echo $form->checkBox($model,'isDomMentor'); ?>
                    <?php echo $form->label($model,'isDomMentor'); ?>
                    <?php echo $form->error($model,'isDomMentor'); ?>
                </div>
                <div class="row rememberMe">
                    <?php echo $form->checkBox($model,'isMentee'); ?>
                    <?php echo $form->label($model,'isMentee'); ?>
                    <?php echo $form->error($model,'isMentee'); ?>
                </div>
            </td>
            <td>
                <p class="note" >Virtual Job Fair Roles:</p>
            	<div class="row rememberMe">
					<?php echo $form->checkBox($model,'isEmployer'); ?>
                    <?php echo $form->label($model,'isEmployer'); ?>
                    <?php echo $form->error($model,'isEmployer'); ?>
                </div>
                <div class="row rememberMe">
                    <?php echo $form->checkBox($model,'isStudent'); ?>
                    <?php echo $form->label($model,'isStudent'); ?>
                    <?php echo $form->error($model,'isStudent'); ?>
                </div>
            </td>
        	<td>
            	<p class="note" >Remote Mobil Judge Roles:</p>
            	<div class="row rememberMe">
					<?php echo $form->checkBox($model,'isJudge'); ?>
                    <?php echo $form->label($model,'isJudge'); ?>
                    <?php echo $form->error($model,'isJudge'); ?>
                </div>
                <div class="row rememberMe">
                    <?php echo $form->checkBox($model,'isStudent'); ?>
                    <?php echo $form->label($model,'isStudent'); ?>
                    <?php echo $form->error($model,'isStudent'); ?>
                </div>
            </td>        
        </tr>
    </table>
    -->
	
   
</div><!-- form -->
