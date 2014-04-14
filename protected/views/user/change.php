<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>


<div class="wide form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-Register-form',
        'enableAjaxValidation'=>false,
    )); ?>



	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <!--<p style="color:red" id="errors"></p>-->
	<div id="regbox">
		<?php echo $form->labelEx($model,'fname'); ?> <br/>
        <?php echo $form->textField($model,'fname',array('size'=>45,'maxlength'=>45)); ?><br/>
        <?php echo $form->error($model,'fname'); ?><br/>
    
        <?php echo $form->labelEx($model,'mname'); ?><br/>
        <?php echo $form->textField($model,'mname',array('size'=>45,'maxlength'=>45)); ?><br/>
        <?php echo $form->error($model,'mname'); ?><br/>
    
        <?php echo $form->labelEx($model,'lname'); ?><br/>
        <?php echo $form->textField($model,'lname',array('size'=>60,'maxlength'=>100)); ?><br/>
        <?php echo $form->error($model,'lname'); ?><br/>

		<?php echo $form->labelEx($model,'email'); ?><br/>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?><br/>
        <?php echo $form->error($model,'email'); ?><br/>

        <?php echo $form->labelEx($model,'isAdmin'); ?>
        <?php echo $form->checkBox($model,'isAdmin',array('style'=>'float:left')); ?><br/>

        <?php echo $form->labelEx($model,'disable'); ?>
        <?php echo $form->checkBox($model,'disable',array('style'=>'float:left')); ?>

    </div>

    <div id="regbox">
		<?php echo $form->labelEx($model,'men_role'); ?> <br/>
        <?php echo $form->checkBox($model,'isProMentor',array('style'=>'float:left')); ?>
        <p style="float:left; margin-left:5px">Project Mentor</p></br></br>
        <?php echo $form->checkBox($model,'isPerMentor',array('style'=>'float:left')); ?>
        <p style="float:left; margin-left:5px">Personal Mentor</p></br></br>
        <?php echo $form->checkBox($model,'isDomMentor',array('style'=>'float:left')); ?>
        <p style="float:left; margin-left:5px">Domain Mentor</p></br></br>
        <?php echo $form->checkBox($model,'isMentee',array('style'=>'float:left')); ?>
        <p style="float:left; margin-left:5px">Mentee</p></br></br>

        <?php echo $form->labelEx($model,'vjf_role'); ?><br/>
        <?php echo $form->checkBox($model,'isEmployer',array('style'=>'float:left')); ?>
		<p style="float:left; margin-left:5px">Employer</p></br></br>
		<?php echo $form->checkBox($model,'isStudent',array('style'=>'float:left')); ?>
		<p style="float:left; margin-left:5px">Student</p></br></br>

        <?php echo $form->labelEx($model,'rmj_role'); ?><br/>
        <?php echo $form->checkBox($model,'isJudge',array('style'=>'float:left')); ?>
        <p style="float:left; margin-left:5px">Judge</p></br></br>
        <?php echo $form->checkBox($model,'isStudent',array('style'=>'float:left')); ?>
        <p style="float:left; margin-left:5px">Student</p>
    </div>
    <div style="margin-top: 390px">
    	<?php echo CHtml::submitButton('Save', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
    </div> 	
    <?php $this->endWidget(); ?>  
    <div style="clear:both"></div>
	</br>

    <!--
    <script>
        $.MyNamespace={
            submit : "true"
        };
        $(document).ready(function() {
            $("#user-Register-form").submit(function(e) {
                form = e;
                $.ajaxSetup({async:false});

                var response = $.post("/coplat/index.php/User/verifyRegistration", $("#user-Register-form").serialize());

                response.done(function(data) {
                    if (data != ""){
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                        $("#errors").html(data);
                        $.MyNamespace.submit = 'false';
                    } else {
                        $.MyNamespace.submit = 'true';
                    }
                });
                if ($.MyNamespace.submit == 'false'){
                    e.preventDefault();
                }
            });
            return;
        });
    </script>
    -->
</div><!-- form -->