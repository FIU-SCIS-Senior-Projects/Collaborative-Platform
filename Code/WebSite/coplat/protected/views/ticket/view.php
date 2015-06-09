<?php
/* @var $this TicketController */
/* @var $model Ticket */
/*this refers a ticket */

?>
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
    input.large{
        width: 90%;

    }
</style>
<div style="color: #0044cc"><h3>Ticket #  <?php echo $model->id; ?></h3></div>
<br>
<div id="fullcontent">
    <div>
        <div class="span6" style="width: 800px; margin-left: 0px">
            <table cellpadding="0" cellspacing="0" border="0"
                   class="table table-striped table-bordered table-fixed-header"
                   id="#mytable" width="100%" style="table-layout:fixed">
                <tr style="background-color: #C9E0ED">
                    <td width="15%"><h5>Creator </h5></td>
                    <td width="85%"><?php echo $userCreator->fname . ' ' . $userCreator->lname; ?> </td>
                </tr>
                <tr style="background-color: #EEE">
                    <td width="15%"><h5>Domain</h5></td>
                    <td width="85%"><?php echo $domainName->name; ?> </td>
                </tr>
                <tr style="background-color: #C9E0ED">
                    <td width="15%"><h5>Sub-Domain</h5></td>
                    <td width="85%">
                        <?php
                        if ($subdomainName != null)
                            echo $subdomainName->name;
                        else
                            echo "--";
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #EEE">
                    <td width="15%"><h5>Status</h5></td>
                    <td width="85%"><?php echo $model->status; ?></td>
                </tr>
                <tr style="background-color: #C9E0ED">
                    <td width="15%"><h5>Date Created</h5></td>
                    <td width="85%"><?php echo date("M d, Y", strtotime($model->created_date)); ?></td>
                </tr>
                <tr style="background-color: #EEE">
                    <td width="15%"><h5>Description </h5></td>
                    <td width="85%"><?php echo $model->description; ?></td>
                </tr>
                <tr style="background-color:#C9E0ED">
                    <td width="15%"><h5>Assigned To</h5></td>
                    <td width="85%"><?php echo $userAssign->fname . ' ' . $userAssign->lname; ?></td>
                </tr>
                <tr style="background-color: #EEE">
                    <td width="15%"><h5>Priority</h5></td>
                    <td width="85%"><?php echo $priority->description; ?></td>
                </tr>
                <tr style="background-color: #EEE">
                    <td width="15%"><h5>Attachment</h5></td>
                    <td width="85%">    <?php if ($model->file != null) {
                            //echo CHtml::link(CHtml::encode('Download File'), $model->file, array('target'=>'_blank', 'style'=>'float:left'));
                            echo '<a href="/coplat/index.php/ticket/download?download_file='.$model->file.'">Click here to download the file</a>';
                        } else {
                            echo 'No File Uploaded';
                        }
                        ?>
                    </td>
                    <br>
                </tr>


            </table>
        </div>
    </div>

    <div class="span2"> <!-- Buttons Options -->
        <?php if ($model->status != 'Close' && $model->status != 'Reject' ) { ?>
            <!-- Comment Button -->
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Add Comment',
                'type' => 'primary',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#myModalComment',
                    'style' => 'width: 120px',
                ),
            )); ?>
        <?php } ?>
        <br/>
        <br/>
        <!-- Change Status Button -->
        <?php
        if (((User::getCurrentUserId() == $userCreator->id) || User::isCurrentUserAdmin())
            && $model->status != 'Close' && $model->status != 'Reject') {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Change Status',
                'type' => 'primary',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#myModalChangeStatus',
                    'style' => 'width: 120px',
                ),
            ));
        } ?>
        <br/>
        <br/>
        <!-- Button trigger modal Reassign -->
        <?php
        if ( (User::isCurrentUserAdmin() && $model->status == 'Pending') || 
              (User::isCurrentUserDomMentor() && $model->status == 'Pending' && 
               $tier !== null && $tier->tier_team == 1 && User::getCurrentUserId()== $model->assign_user_id  && 
               User::getCurrentUserId() != $model->creator_user_id ))
        {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Re Assign',
                'type' => 'primary',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#myModalReAssign',
                    'style' => 'width: 120px',
                ),
            ));
        }?>
        <br/>
        <br/>
        <!-- Button trigger escalate -->
        <?php
        if ( (User::isCurrentUserAdmin() && $model->status == 'Pending') || (User::isCurrentUserDomMentor() && $model->status == 'Pending' && $tier !== null && $tier->tier_team == 1 && User::getCurrentUserId()== $model->assign_user_id  && User::getCurrentUserId() != $model->creator_user_id ))
        {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Escalate',
                'type' => 'primary',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#myModalEscalate',
                    'style' => 'width: 120px'
                ),
            ));
        }?>
        <br>
        <br>
        <?php
        if(User::isCurrentUserAdmin() || User::isCurrentUserDomMentor()){
                $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Schedule Meeting',
                'type' => 'primary',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#myModalScheduleVC',
                    'style' => 'width: 120px'
                ),
            ));
        }

        ?>

    </div>
    <!-- End Buttons Options -->

    <br>
    <!-- End Container -->
    <br>

    <div class="container" style="width: 800px; margin-left: 0px; overflow-y: scroll">
        <div style="color: #0044cc"><h3>Comments</h3></div>
        <br>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-fixed-header"
               id="example"
               width="100%">
            <thead class="header">
            <tr style="background-color: #EEE">
                <th width="1%"> No</th>
                <th width="65%">Description</th>
                <th width="14%">Date Added</th>
                <th width="30%">Added by</th>
            </tr>
            </thead>
            <?php foreach ($model->comments as $comment) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $comment->id; ?></td>
                    <td><?php echo $comment->description ?></td>
                    <td><?php echo date("M d, Y", strtotime($comment->added_date)) ?></td>
                    <td><?php echo $comment->user_added ?></td>
                </tr>
                </tbody>
            <?php
            }
            ?>
        </table>
    </div>
    
     <div class="container" style="width: 800px; margin-left: 0px; overflow-y: scroll">
        <div style="color: #0044cc"><h3>Events</h3></div>
        <br>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-fixed-header"
               id="example"
               width="100%">
            <thead class="header">
            <tr style="background-color: #EEE">
                <th width="1%"> No</th>
                <th width="14%">Event Date</th>
                <th width="30%">Description</th>
                <th width="15%">Performed by</th>
            </tr>
            </thead>
            <?php foreach ($model->ticketEvents as $event) { ?>
                <tbody>
                    <tr>
                        <td><?php echo $event->id; ?></td>
                        <td><?php echo date("M d, Y h:m A", strtotime($event->event_recorded_date)) ?></td>
                        <td><?php echo $event->getEventDescription() ?></td>                    
                        <td><?php echo $event->eventPerformedByUser->getFullName() ?></td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
        </table>
    </div>
    
    
    
    
    <!-- End List of Comments -->
</div> <!-- END FULL CONTENT -->
<!-- End List of Comments -->
<?php /*$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModalComment')); */ ?>
<!-- Modals -->
<div class="modal fade" id="myModalComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Append Comment to a Ticket #<?php echo $model->id ?></h4>
    </div>
    <div class="modal-body">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'comment-form',
            //'enableAjaxValidation'=>false,
        )); ?>
        <div style="margin-left:20px">
            <?php $comment = new Comment(); ?>
            <!--  	<input style ="display:none" type = "text" id = "ticket_id" value=<?php /*echo $model->id;*/ ?>></input>-->
            <?php echo $form->textArea($comment, 'description', array(
                'id' => 'description', 'style' => 'width:480px', 'cols' => 20, 'rows' => 5,
                'width' => '400px')); ?>
        </div>
    </div>
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'Submit', 'type' => 'primary', 'label' => 'Append', 'url' => '#',
            'htmlOptions' => array('id' => 'append'),
        ));
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Close', 'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        ));
        ?>
        <?php /*$this->endWidget() */ ?>
        <?php $this->endWidget() ?>
    </div>
</div>
<!-- Script for Comment modal -->
<script>
    $('a#append').on('click', function () {
        $.post('/coplat/index.php/comment/create/<?php echo $model->id?>', $('#comment-form').serialize(), function (message) {
            window.location = location;
        });
        return false;
    })
</script>
<!-- End Comment Modal


<!-- Modal RE-ASSIGN-->

<div class="modal fade" id="myModalReAssign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Re-Assign Ticket #<?php echo $model->id ?></h4>
    </div>
    <div class="modal-body">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'ticket-form',
            //'enableAjaxValidation'=>false,
        )); ?>
        <!-- <input style ="display:none" type = "text" id = "ticket_id" value='<?php /* echo $model->id;*/ ?>'</input>
                <input style ="display:none" type = "text" id = "domain_id" value='<?php /*echo $model->domain_id;*/ ?>'</input>
                <input style ="display:none" type = "text" id = "creator_user_id" value='<?php /*echo $model->creator_user_id;*/ ?>'</input>
                <input style ="display:none" type = "text" id = "status" value='<?php /*echo $model->status;*/ ?>'</input>
                <input style ="display:none" type = "text" id = "created_date" value='<?php /*echo $model->created_date; */ ?>'</input>
                <input style ="display:none" type = "text" id = "subject" value='<?php /*echo $model->subject; */ ?>'</input>
                <input style ="display:none" type = "text" id = "description" value='<?php /*echo $model->description; */ ?>'</input>
                <input style ="display:none" type = "text" id = "domain_id" value='<?php /*echo $model->domain_id;*/ ?>'</input>
                <input style ="display:none" type = "text" id = "subdomain_id" value='<?php /*echo $model->subdomain_id; */ ?>'</input>
                <input style ="display:none" type = "text" id = "file" value='<?php /*echo $model->file;*/ ?>'</input> -->
        <?php
        //Logic to identified is a subdomain is being specified
        $userDomain = User::model()->findAllBySql("SELECT * FROM user WHERE activated =:activated and (isAdmin =:isAdmin or isDomMentor=:isDomMentor and id!=:userid)", 
                                                 array(':activated' => 1, ':isAdmin' => 1, ':isDomMentor' => 1, ':userid' => User::getCurrentUserId()));
        $data = array();
        //tito
        foreach ($userDomain as $mod) {
            $data[$mod->id] = $mod->fname . ' ' . $mod->lname;
        }
        ?>
        <?php echo $form->labelEx($mod, 'Domain Mentor'); ?>
        <?php echo $form->dropDownList($model, 'assign_user_id', $data, array('prompt' => 'Select')); ?>
        <?php echo $form->error($model, 'assign_user_id'); ?>

        <?php $this->endWidget() ?>


        <?php
        /*Leave a message when the ticket is reassign */
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'message-form',
            //'enableAjaxValidation'=>false,
        )); ?>
        <div>
            <h4>Comment</h4>
            <?php $comment = new Comment(); ?>
            <!--  	<input style ="display:none" type = "text" id = "ticket_id" value=<?php /*echo $model->id;*/ ?>></input>-->
            <?php echo $form->textArea($comment, 'description', array(
                'id' => 'description', 'style' => 'width:480px', 'cols' => 20, 'rows' => 5,
                'width' => '400px')); ?>
        </div>


        <?php /*echo $form->textField($model, 'assign_user_id', array('size' => 1, 'maxlength' => 1)); */ ?>
    </div>

    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'Submit', 'type' => 'primary', 'label' => 'Reassign', 'url' => '#',
            'htmlOptions' => array('id' => 'reassign'),
        ));
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Close', 'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        ));
        ?>
        <?php $this->endWidget() ?>
    </div>
</div>

<!-- Script for Reassign modal -->
<script>
    $('a#reassign').on('click', function () {
        var confirmed = confirm("Do you really want to reassign the ticket?");
        if (confirmed) {
            $.post('/coplat/index.php/ticket/reassign/<?php echo $model->id?>', $('#ticket-form').serialize(), function (message) {
                var url = message.url;
                $.post('/coplat/index.php/comment/message/<?php echo $model->id?>', $('#message-form').serialize(), function (message) {
                    window.location = url;
                });
            }, 'json');
        }
        return false;
    })
</script>


<!-- Modal Change Status-->
<div class="modal fade" id="myModalChangeStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Change Status of Ticket #<?php echo $model->id ?></h4>
    </div>
    <div class="modal-body">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'ticket-form-status',
            //'enableAjaxValidation'=>false,
        )); ?>
        <?php
        $data = array("Close", "Reject");
        ?>
        <?php echo $form->labelEx($model, 'Status'); ?>
        <?php echo $form->dropDownList($model, 'status', $data, array('prompt' => 'Select')); ?>
        <?php echo $form->error($model, 'status'); ?>


        <?php $this->endWidget() ?>


        <?php
        /*Leave a message when the ticket is reassign */
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'message-status-form',
            //'enableAjaxValidation'=>false,
        )); ?>
        <div>
            <h4>Leave Comment</h4>
            <?php $comment = new Comment(); ?>
            <!--  	<input style ="display:none" type = "text" id = "ticket_id" value=<?php /*echo $model->id;*/ ?>></input>-->
            <?php echo $form->textArea($comment, 'description', array(
                'id' => 'description', 'style' => 'width:480px', 'cols' => 20, 'rows' => 5,
                'width' => '400px')); ?>
        </div>

    </div>
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'Submit', 'type' => 'primary', 'label' => 'Change Status', 'url' => '#',
            'htmlOptions' => array('id' => 'change'),
        ));
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Close', 'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        ));
        ?>
        <?php /*$this->endWidget()*/ ?>
        <?php $this->endWidget() ?>
    </div>
</div>

<!-- Modal Escalate-->
<div class="modal fade" id="myModalEscalate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Do you want to escalate Ticket #<?php echo $model->id ?>?</h4>
    </div>


    <div class="modal-body">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'escalate-form',
            //'enableAjaxValidation'=>false,
        )); ?>


        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'Submit', 'type' => 'primary', 'label' => 'Escalate', 'url' => '#',
            'htmlOptions' => array('id' => 'escalate'),
        ));
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Close', 'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        ));
        ?>
        <?php $this->endWidget() ?>

    </div>

</div>


<!-- Script for Escalate -->
<script>
    $('a#escalate').on('click', function () {

        $.post('/coplat/index.php/ticket/escalate/<?php echo $model->id?>', $('#escalate-form').serialize(), function (message) {
            var url = message.url;
            // $.post('/coplat/index.php/comment/escalate/<?php echo $model->id?>', $('#escalate-form').serialize(), function (message) {
            window.location = url;
            //});
        }, 'json');

        return false;
    })
</script>


<!-- Schedule VC Modal -->
<div class="modal fade" id="myModalScheduleVC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Schedule Video Conference For Ticket #<?php echo $model->id ?></h4>
    </div>
    <div class="modal-body">
        <div class="form" style="margin-left: 30px">
       <form id="video-conference-form" method="POST" action="/coplat/index.php/videoConference/createfrommodal">

        <div id="message_box"></div>

        <div class="row">
            <label for="subject">Subject</label>
            <input value="<?php echo  $model->subject. " - Ticket #" . $model->id?>" class="large" id="subject" type="text" name="VideoConference[subject]">
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

        </div>

        <div class="meeting-date-input row" id="time-in">
            <label for="time">Time</label>
            <input placeholder="09:00 am" id="time" type="text" name="time">
        </div>

        <div class="row">
            <label for="notes">Notes</label>
            <input class="large" value="<?php echo $model->description ?>" id="notes" type="text" name="VideoConference[notes]">
        </div>




        <div class="invitee_emails">
            <div class="row">
                <?php $creatorEmail = User::model()->findByPk($model->creator_user_id)->email; ?>
                <label for="invitee-1">Creator Email</label>
                <input placeholder="" value="<?php echo $creatorEmail;?>" id="invitee-1" type="email" name="invitees[]">
            </div>
            <div class="row">
                <?php $assignedToEmail = User::model()->findByPk($model->assign_user_id)->email; ?>
                <label for="invitee-2">Assigned To Email</label>
                <input placeholder="" value="<?php echo $assignedToEmail;?>" id="invitee-2" type="email" name="invitees[]">
                <button type="button" class="btn btn-info add_field_button"><i class="fa fa-plus"></i></button>
            </div>
        </div>


        <div class="row buttons">
            <?php echo CHtml::submitButton("Schedule", array('class' => 'btn btn-primary', 'id' => 'btnSubmit')); ?>
        </div>

        </form>
        </div>
    </div>
</div>
<!-- Script for VC modal -->
<script>
    $(document).ready(function() {
        $('#video-conference-form').submit(function(event) {
            var form = $(this);
            var method = form.attr('method');
            var action = form.attr('action');
            var data = form.serialize();
            ajaxGeneric(action, method, data, "#message_box");
            setTimeout(closeModal, 5000);     //wait 5 seconds
            event.preventDefault(); // Prevent the form from submitting via the browser.
        });

        $('#btnSubmit').click(function() {
            <?php TicketEvents::recordEvent(10,$model->id, null, null , null); ?>;
        });
    });

    function closeModal(){
       $('#myModalScheduleVC').modal('toggle');
    }


    function ajaxGeneric(action, method, params, response_target) {
        var infoBox = $(response_target);
        $.ajax({
            type : method,
            url : action,
            data : params,
            success : function(response) {
                if (response == "OK") {
                    infoBox.removeClass("alert-danger");
                    infoBox.addClass("alert-success");
                    infoBox.html("The meeting has been successfully scheduled");
                } else {
                    infoBox.removeClass("alert-success");
                    infoBox.addClass("alert-danger");
                    infoBox.html(response);
                }
            }
        }).done(function() {

        }).fail(function() {
            infoBox.removeClass("alert-success");
            infoBox.addClass("alert-danger");
            infoBox.html("Your request cannot be completed at this time");

        });

    }



</script>
<!--Script to hide and show the meeting date -->
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
<!-- creates more emails input fields -->
<script>
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".invitee_emails"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x = 2; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row"><label for="invitee-'+x+'">Invitee '+x+' Email</label><input placeholder="" type="email" id="invitee-' + x + '" name="invitees[]"/><a href="#" class="remove_field">&nbsp;&nbsp;<i class="fa fa-times"></i></a></div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>


<!-- End Schedule VC Modal








<!-- Script for Comment modal -->
<script>
    $('a#change').on('click', function () {
        var confirmed = confirm("Do you really want to proceed?");
        if (confirmed) {
            $.post('/coplat/index.php/ticket/change/<?php echo $model->id?>', $('#ticket-form-status').serialize(), function (message) {
                var url = message.url;
                $.post('/coplat/index.php/comment/message/<?php echo $model->id?>', $('#message-status-form').serialize(), function (message) {
                    window.location = url;
                });
            }, 'json');
        }
        return false;
    })
</script>




<script>
    $('#my-back').on('click', function () {
        window.history.back();
        return false;
    });
    $('.table-fixed-header').fixedHeader();
</script>

