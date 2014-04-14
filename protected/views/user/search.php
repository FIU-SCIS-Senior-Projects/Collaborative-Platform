<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">
	<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>
	<div id="regbox">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
	
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	
		<?php echo $form->label($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>45,'maxlength'=>45)); ?>
	
		<?php echo $form->label($model,'lname'); ?>
		<?php echo $form->textField($model,'lname',array('size'=>60,'maxlength'=>100)); ?>
		</br></br>
		<?php 
			echo $form->checkBox($model,'disable',array('style'=>'float:left'));
			echo $form->label($model,'disable'); 
		?>
        <?php 
			echo $form->checkBox($model,'activated',array('style'=>'float:left'));
			echo $form->label($model,'activated'); 
		?>
        </br>
    </div> <!-- regbox -->
    <div id="regbox" style="margin-left:10px;width:220px!important">
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
    	
		<?php 
            echo $form->labelEx($model,'vjf_role');?>
        <?php 
			echo $form->checkBox($model,'isEmployer',array('style'=>'float:left'));
		?>
		<p style="float:left; margin-left:5px">Employer</p></br></br>
		
		<?php 
			echo $form->checkBox($model,'isStudent',array('style'=>'float:left'));
		?>
		<p style="float:left; margin-left:5px">Student</p></br></br>			
    	
		<?php 
            echo $form->labelEx($model,'rmj_role');
            echo $form->checkBox($model,'isJudge',array('style'=>'float:left'));
        ?>
        <p style="float:left; margin-left:5px">Judge</p></br></br>
        
		<?php 
            echo $form->checkBox($model,'isStudent',array('style'=>'float:left'));
        ?>
        <p style="float:left; margin-left:5px">Student</p><label>&nbsp;&nbsp;&nbsp;</label>
    
    	<?php echo CHtml::submitButton('Search', array("class"=>"btn btn-primary")); ?>
   	</div>
     	
    <?php $this->endWidget(); ?>  
    <div style="clear:both"></div>
	</br>

</div><!-- search-form -->