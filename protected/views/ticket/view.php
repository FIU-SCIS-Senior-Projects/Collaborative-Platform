<?php
/* @var $this TicketController */
/* @var $model Ticket */
/*this refers a ticket */

?>
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
                    <td width="15%"><h5>Attachment</h5></td>
                    <td width="85%">    <?php if ($model->file != null) {
                            //echo CHtml::link(CHtml::encode('Download File'), $model->file, array('target'=>'_blank', 'style'=>'float:left'));
                            echo '<a href="download?download_file=' . $model->file . '">Click here to download the file</a>';
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
        <?php if ($model->status != 'Close') { ?>
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
        if (((User::getCurrentUserId() == $userCreator->id) || User::isCurrentUserAdmin()) && $model->status != 'Close') {
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
        if ((User::isCurrentUserAdmin() || User::isCurrentUserDomMentor() || User::isCurrentUserProMentor()) && $model->status != 'Close') {
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

        <?php
        /*$tier = UserDomain::model()->find("user_id=:id", array(':id' => $model->assign_user_id));

        if ($tier->tier_team == 1) {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Escalate',
                'type' => 'primary',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#myModalEscalate',
                    'style' => 'width: 120px',
                ),
            ));
        } */
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
        $userDomain = User::model()->findAll("isDomMentor=:isDomMentor", array(':isDomMentor' => 1));
        $data = array();
        foreach ($userDomain as $mod) {
            $data[$mod->id] = $mod->fname . ' ' . $mod->lname;
        }
        ?>
        <?php echo $form->labelEx($mod, 'Domain Mentor'); ?>
        <?php echo $form->dropDownList($model, 'assign_user_id', $data, array('prompt' => 'Select')); ?>
        <?php echo $form->error($model, 'assign_user_id'); ?>


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
        <?php /*$this->endWidget()*/ ?>
        <?php $this->endWidget() ?>
    </div>
</div>
<!-- Script for Comment modal -->
<script>
    $('a#reassign').on('click', function () {
        var confirmed = confirm("Do you really want to reassign the ticket?");
        if (confirmed) {
            $.post('/coplat/index.php/ticket/reassign/<?php echo $model->id?>', $('#ticket-form').serialize(), function (message) {
                window.location = location;
            });
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

<!-- Script for Comment modal -->
<script>
    $('a#change').on('click', function () {
        var confirmed = confirm("Do you really want to change the ticket status?");
        if (confirmed) {
        $.post('/coplat/index.php/ticket/change/<?php echo $model->id?>', $('#ticket-form-status').serialize(), function (message) {
            window.location = location.pathname;
        });
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
