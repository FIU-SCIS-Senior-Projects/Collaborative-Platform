<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */

function accept($vcid){
    return CHtml::ajaxLink('Accept',
        Yii::app()->createAbsoluteUrl('videoConference/accept/'.$vcid),
        array(
            'type'=>'get',
            'data' => array('id' =>$vcid,'type'=>'get'),
            'update'=>'message',
            'success' => 'function(response) {
                                $(".message").html(response);
                                location.reload();
                                }',
        ),
        array( 'confirm'=>'Are you sure you want to accept this invitation?', 'role' => "button", "class" => "btn btn-success")
    );
}

function reject($vcid){
    return CHtml::ajaxLink('Reject',
        Yii::app()->createAbsoluteUrl('videoConference/reject/'.$vcid),
        array(
            'type'=>'get',
            'data' => array('id' =>$vcid,'type'=>'get'),
            'update'=>'message',
            'success' => 'function(response) {
                                $(".message").html(response);
                                location.reload();
                                }',
        ),
        array( 'confirm'=>'Are you sure you want to reject this invitation?', 'role' => "button", "class" => "btn btn-danger")
    );
}

$user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
$ismoderator = $user->id == $model->moderator_id;


$this->breadcrumbs = array(
    'Video Conferences' => array('index'),
    $model->id,
);

//array('label' => 'Update VideoConference', 'url' => array('update', 'id' => $model->id)),
//array('label' => 'Manage VideoConference', 'url' => array('admin')),

$this->menu = array(
    array('label' => 'List VideoConference', 'url' => array('index')),
    array('label' => 'Create VideoConference', 'url' => array('create')),
    array('label' => 'Delete VideoConference', 'url' => '#', 'visible' => $ismoderator, 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label'=>'View Past/Deleted Video Conferences', 'url'=>array('viewDeleted'))
);
?>

    <style>
        .error-message {
            background-color: #f2dede;
            border-radius: 3px;
            padding: 10px;
        }

        div.mbox {
            width: 500px;
            padding: 15px;
            margin-bottom: 15px;
            margin-top:30px;
            border-radius: 4px;
        }

        .mbox p {
            margin: 0px 0px 0px;
        }

        a.mbox {
            color: #31708f;
        }

        .mbox span {
            font-weight: bold;
            margin-right: 6px;
        }

        .mbox ul {
            margin: 0;
        }

        .mbox hr {
            border-top: 1px solid #19536c;
            border-bottom: 0px;
            margin: 5px 0px;
        }

        .ui-tooltip {
            padding: 3px;
            font-size: smaller;
        }

        .mbox button, .mbox .btn{
            padding: 2px 4px;
            font-size: small;
            margin-right: 4px;
        }
        .cancelled{
            background-color: #f4ffbc;
        }

    </style>



    <h3><?php echo $model->subject; ?></h3>



    <?php

    $ismoderator = $user->id == $model->moderator_id;
    $dt = new DateTime($model->scheduled_for);
    $user_friendly_date = $dt->format("m/d/Y h:i a");

    $html = "
        <div id='mbox-$model->id' class='mbox info %MSTATUS%'>
             %STATUS%
            <p>%DATE%</p>
            <hr>
            %PARTICIPANTS%
            <hr>
            <p><span>Notes:</span>%NOTE%</p>
            <hr>
            " .
        CHtml::link('Join Now', $this->createAbsoluteUrl('videoConference/join/' . $model->id, array(), 'https'), array('role' => "button", "class" => "btn btn-primary"));

    if ($ismoderator) {
        $html .=   CHtml::button('Edit', array('submit' => array('videoConference/update/'.$model->id), "visible" =>  $ismoderator, 'role' => "button", "class" => "btn btn-info"));

        $html .= CHtml::ajaxLink('Delete',
            Yii::app()->createAbsoluteUrl('videoConference/delete/' . $model->id),
            array(
                'type' => 'post',
                'data' => array('id' => $model->id, 'type' => 'delete'),
                'update' => 'message',
                'success' => 'function(response) {
            $(".message").html(response);
            $("#mbox-' . $model->id . '").remove();
            }',
            ),
            array('confirm' => 'Are you sure you want to delete this conference?', "visible" => $ismoderator, 'role' => "button", "class" => "btn btn-danger")
        );
        if($model->status != "cancelled")
            $html .=   CHtml::ajaxLink('Cancel',
                Yii::app()->createAbsoluteUrl('videoConference/cancel/'.$model->id),
                array(
                    'type'=>'post',
                    'data' => array('id' =>$model->id,'type'=>'post'),
                    'update'=>'message',
                    'success' => 'function(response) {
                                $(".message").html(response);
                                location.reload();
                                }',
                ),
                array( 'confirm'=>'Are you sure you want to cancel this conference?', "visible" =>  $ismoderator, 'role' => "button", "class" => "btn btn-warning")
            );
    }
    else{
            $invitation = VCInvitation::model()->findByAttributes(array('videoconference_id' => $model->id, 'invitee_id' => $user->id));
            if($invitation->status == "Unknown"){
                $html .= accept($model->id);
                $html .= reject($model->id);
            }else if($invitation->status == "Accepted"){
                $html .= reject($model->id);
            }else{
                $html .= accept($model->id);
            }

        }

    $html .= "</div>";
    $html = str_replace("%SUBJECT%", $model->subject, $html);
    $html = str_replace("%MSTATUS%", $model->status, $html);
    if($model->status == "cancelled"){
        $html = str_replace("%STATUS%", "<p style='font-weight: bold'>Status: Cancelled</p>", $html);
    }else{
        $html = str_replace("%STATUS%", "", $html);
    }
    $html = str_replace("%SUBJECT%", $model->subject, $html);
    $html = str_replace("%DATE%", $user_friendly_date, $html);
    $html = str_replace("%NOTE%", $model->notes, $html);
    $html = str_replace("%PARTICIPANTS%", $model->findParticipantsHTMLList(), $html);

    echo $html;


    ?>

<?php if (Yii::app()->user->hasFlash('invitation-error')): ?>
    <h3>There were some problems with your invitations: </h3>
    <div style="margin-top:20px;" class="error-message">
        <?php echo Yii::app()->user->getFlash('invitation-error'); ?>
    </div>
<?php endif; ?>

