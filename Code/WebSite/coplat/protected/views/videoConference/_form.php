<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */
/* @var $form CActiveForm */
?>
<link rel="stylesheet"
      href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/fontawesome/css/font-awesome.min.css">
<style>
    .radio-inline {
        display: inline-block;
        padding-left: 20px;
        margin-bottom: 0;
        font-weight: 400;
        vertical-align: middle;
        cursor: pointer;
    }

    label.radio-inline {

        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;

    }
    #meeting-date-input{
        display: none;
    }

    .radio-inline input[type=radio], .checkbox input[type=checkbox], .checkbox-inline input[type=checkbox] {
        position: absolute;
        margin-top: 4px \9;
        margin-left: -20px;
    }

    .add_field_button{
        margin-bottom: 10px;
    }
    form{
        margin-left: 35px;
    }
</style>
<script>
    $(document).ready(function () {
        if($('#now').is(':checked')) {
            $(".meeting-date-input").hide("slow");
        }else{
            $(".meeting-date-input").show("slow");
        }

        $("#now").change(function () {
            $(".meeting-date-input").hide("slow");
        });
        $("#later").change(function () {
            $(".meeting-date-input").show("slow");
        });
    });
</script>
<script>
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".invitee_emails"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        $("#invitee-1").autocomplete({
            source: './../../../../../coplat/index.php/AwayMentor/FindUserName'
        });

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row"><label for="invitee-'+x+'">Invitee '+x+' </label><input placeholder="" type="text" id="invitee-' + x + '" name="invitees[]"/><a href="#" class="remove_field">&nbsp;&nbsp;<i class="fa fa-times"></i></a></div>'); //add input box

                $("#invitee-"+x).autocomplete({
                    source: './../../../../../coplat/index.php/AwayMentor/FindUserName'
                });
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>
<script>
    $(document).ready(function() {
        $('#date').datepicker({
            showAnim: 'fadeIn',
            minDate: 0,
            showButtonPanel: true
        });
    });
</script>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'video-conference-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject'); ?>
        <?php echo $form->error($model, 'subject'); ?>
    </div>

    <div class="row">
        <label class="radio-inline">
            <input id="now" value="now" checked type="radio" name="dateopt">Now
        </label>
        <label class="radio-inline">
            <input id="later" value="later" type="radio" name="dateopt">Later
        </label>
    </div>

    <div class="meeting-date-input row" id="date-in">

        <label for="date">Date</label>
        <input placeholder="mm/dd/yyyy" id="date" type="text" name="date">




        <!--
        <?php echo $form->labelEx($model, 'scheduled_for'); ?>
        <?php echo $form->textField($model, 'scheduled_for'); ?>
        <?php echo $form->error($model, 'scheduled_for'); ?>-->
    </div>

    <div class="meeting-date-input row" id="time-in">
        <label for="time">Time</label>
        <input placeholder="09:00 am" id="time" type="text" name="time">
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'notes'); ?>
        <?php echo $form->textArea($model, 'notes', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'notes'); ?>
    </div>


    <div class="invitee_emails">
        <div class="row">
            <label for="invitee-1">Invitee</label>
            <input placeholder="" id="invitee-1" type="text" name="invitees[]">
            <button type="button" class="btn btn-info add_field_button"><i class="fa fa-plus"></i></button>
        </div>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
        <a href="../../../../coplat/index.php/videoConference/index"><button type="button" class="btn btn-warning">Cancel</button>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
