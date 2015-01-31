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
        <p style="color:rgb(255, 16, 40);"><?php echo $error?></p>


    </div>

    <div id="regbox" style="margin-left:10px;width:180px!important">
        </br>
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
        echo $form->checkBox($model,'isDomMentor',array('style'=>'float:left',));
        ?>
        <p style="float:left; margin-left:5px">Domain Mentor</p></br></br>


    </div>
    <div style="margin-top:470px;margin-left:275px">
        <?php echo CHtml::submitButton('Next', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
    
    <a href=../user/admin>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'label'=>'Cancel',
		'size'=>'medium',
		'type'=> 'danger',
		));?>
	</a>
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