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
		<tr style="background-color: #EEE">
                    <td width="15%"><h5>Sub-Domain</h5></td>
                    <td width="85%">
                        <?php
                            if($subdomainName != null)
                                echo $subdomainName->name;
                            else
                                echo "--";
                        ?>
                    </td>
                </tr>
                <tr style="background-color: #C9E0ED">
                    <td width="15%"><h5>Status</h5></td>
                    <td width="85%"><?php echo $model->status; ?></td>
                </tr>
                <tr style="background-color: #EEE">
                    <td width="15%"><h5>Date Created</h5></td>
                    <td width="85%"><?php echo date("M d, Y", strtotime($model->created_date)); ?></td>
                </tr>
                <tr style="background-color: #C9E0ED">
                    <td width="15%"><h5>Description </h5></td>
                    <td width="85%"><?php echo $model->description; ?></td>
                </tr>
                <tr style="background-color: #EEE">
                    <td width="15%"><h5>Assigned To</h5></td>
                    <td width="85%"><?php echo $userAssign->fname . ' ' . $userAssign->lname; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="span2"> <!-- Buttons Options -->
        <table>
            <tr><td>
                    <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'link', 'url' => '#',
                        'htmlOptions' => array('style' => 'width: 120px',
                            'id' => 'my-back',
                        ),
                        'type' => 'primary', 'label' => 'Back'));
?>
            </tr></td><td><br>
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
            </tr></td><td><br>
                <!-- Button trigger modal -->
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Re-Assign',
                    'type' => 'primary',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#myModalReAssign',
                        'style' => 'width: 120px',
	),
)); ?>
            </td></tr>
        </table>
        <!-- Update Button  -->
        <?php
        /*$this->widget('bootstrap.widgets.TbButton', array(
             'buttonType'=>'link', 'id'=>'new-box', 'url'=>array('update', 'id'=>$model->id),*/
        //'confirm' => 'Do you want to proceed and make change on this ticket?',
        /*'type'=>'primary', 'label'=>'Edit'));*/
        ?>
        <!-- Delete Button -->
        <?php /*echo CHtml::button('Delete', array("class"=>"btn btn-primary", 'submit' => array('Delete', 'id'=>$model->id),
			'confirm' => 'Do you want to Drop this ticket from the Mentoring Module?')); */
        ?>
    </div>
    <!-- End Buttons Options -->
    <div class="span6" style="width: 800px; margin-left: 0px">
        <div style="color: #0044cc"><h3>Attachment</h3>
            <?php if ($model->file != null) {
                //echo CHtml::link(CHtml::encode('Download File'), $model->file, array('target'=>'_blank', 'style'=>'float:left'));
                echo '<a href="download?download_file=' . $model->file . '">Click here to download the file</a>';
            } else {
                echo 'No File Uploaded';
            }
            ?>
        </div>
        <br>
    </div>
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
            <tr>
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
        <?php /*$this->endWidget()*/ ?>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Re-Assign Ticket</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Re-Assign</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#my-back').on('click', function () {
        window.history.back();
        return false;
    });
    $('.table-fixed-header').fixedHeader();
</script>