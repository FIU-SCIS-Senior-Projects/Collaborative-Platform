<?php
/* @var $this TicketController */
/* @var $model Ticket */
/*this refers a ticket */

?>
<div id="fullcontent">
<div style="color: #0044cc"><h3>Ticket #  <?php echo $model->id; ?></h3></div>

    <div id="container">
        <div style="border: 1px solid #C9E0ED; border-radius: 5px;">
            <?php
            /*$this->widget('zii.widgets.CDetailView', array(
                'data' => $model, 'attributes' => array(
                    'id', 'creator_user_id, 'domain_id', 'status', 'created_date', 'subject',
                    'description', 'assign_user_id'
                ),
            ));*/
            ?>
            <table style="width: 1000px">
             <tr style="background-color: #C9E0ED"> <td style="width: 300px"><h5>Creator </h5></td><td><?php echo $userCreator->fname.' '.$userCreator->lname;?> </td> </tr>
             <tr style="background-color: #EEE">    <td style="width: 300px"><h5>Domain</h5> </td><td><?php echo $domainName->name;?> </td> </tr>
             <tr style="background-color: #C9E0ED"> <td style="width: 300px"><h5>Status</h5>  </td><td><?php echo $model->status; ?></td></tr>
             <tr style="background-color: #EEE">    <td style="width: 300px"><h5>Date Created</h5>  </td><td><?php echo date("M d, Y",strtotime($model->created_date));?></td></tr>
             <tr style="background-color: #C9E0ED"> <td style="width: 300px"><h5>Description </h5> </td><td><?php echo $model->description; ?></td></tr>
             <tr style="background-color: #EEE">    <td style="width: 300px"><h5>Assigned To Domain Mentor</h5>  </td><td><?php echo $userAssign->fname.' '.$userAssign->lname;?></td></tr>

            </table>

        </div>
    </div>
<br>
<div style="height: 50px; width: 300px; border: 0px solid #C9E0ED; border-radius: 5px;">
<div style="color: #0044cc"><h3>Attachment</h3>
    <?php if($model->file != null){
                //echo CHtml::link(CHtml::encode('Download File'), $model->file, array('target'=>'_blank', 'style'=>'float:left'));
                echo '<a href="download?download_file='.$model->file.'">Download here</a>';

            }else {
                echo 'No File Uploaded';
            }
            ?>
        </div>

    </div>

<!-- End Container -->

<div style="margin-top: 15px"> <!-- Buttons Options -->
    <div>

        <!-- Cancel Button and render to index -->
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'link', 'id' => 'new-box', 'url' => '/coplat/index.php/ticket/index',
            'type' => 'primary', 'label' => 'Back'));
        ?>&nbsp;&nbsp;
        <!-- New Button
	        <?php
        /*$this->widget('bootstrap.widgets.TbButton', array(
          'buttonType'=>'link', 'id'=>'new-box', 'url'=>'/coplat/index.php/ticket/create',
          'type'=>'primary', 'label'=>'New', ));*/
        ?>

	    <!-- Update Button  -->
        <?php
        /*$this->widget('bootstrap.widgets.TbButton', array(
             'buttonType'=>'link', 'id'=>'new-box', 'url'=>array('update', 'id'=>$model->id),*/
        //'confirm' => 'Do you want to proceed and make change on this ticket?',
        /*'type'=>'primary', 'label'=>'Edit'));*/
        ?>

        <!-- Comment Button -->
        <?php /*echo CHtml::button('Comment', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),
	 		)); */
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Comment',
            'type' => 'primary',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#myModalComment',
                'style' => 'width: 100px',
            ),
        ));
        ?>&nbsp;&nbsp;
        <!-- Re-Assign Button -->
        <?php /*echo CHtml::button('Re-Route', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),
	 		));*/
        ?>
        <!-- Button trigger modal -->
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Re-Assign',
            'type' => 'primary',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#myModalReAssign',
                'style' => 'width: 100px',
            ),
        ));
        ?>
        <!-- Answer Button -->
        <?php /*echo CHtml::button('Answer', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),));*/
        ?>
        <!-- Button trigger modal -->
        <?php /*$this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Answer',
                'type'=>'primary',
                'htmlOptions'=>array(
                    'data-toggle'=>'modal',
                    'data-target'=>'#myModalAnswer',
                    'style'=>'width: 100px',
                ),
            ));*/
        ?>
        <!-- Delete Button -->
        <?php /*echo CHtml::button('Delete', array("class"=>"btn btn-primary", 'submit' => array('Delete', 'id'=>$model->id),
			'confirm' => 'Do you want to Drop this ticket from the Mentoring Module?')); */
        ?>
    </div>
</div>
<!-- End Buttons Options -->
<br>

<div style="color: #0044cc"><h3>Comments</h3></div>
<div> <!-- List of Comments to a Ticket -->
    <div style="height: 300px; width: 1000px; overflow-y: scroll; border-radius: 5px;">
        <div>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">

            <thead>
                <tr>
                    <th width="1%"> No</th>
                    <th width="70%">Description</th>
                    <th width="14%">Date Added</th>
                    <th width="25%">Added by</th>
                </tr>
                </thead>
                <?php foreach ($model->comments as $comment) {
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $comment->id; ?></td>
                        <td><?php echo $comment->description ?></td>
                        <td><?php echo date("M d, Y", strtotime($comment->added_date)) ?></td>
                        <td><?php echo $comment->user_added?></td>
                    </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<!-- End List of Comments -->





<!-- End List of Comments -->

<!-- Modals -->

<div class="modal fade" id="myModalComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

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
     aria-hidden="true">
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


<!-- Modal ANSWER TICKET-->
<div class="modal fade" id="myModalAnswer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Answer</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>

</div> <!-- END FULL CONTENT -->