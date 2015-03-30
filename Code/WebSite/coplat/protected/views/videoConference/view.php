<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */


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
    array('label' => 'Delete VideoConference', 'url' => '#', 'visible' => $ismoderator, 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'))

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

    </style>



    <h3><?php echo $model->subject; ?></h3>



    <?php

    $ismoderator = $user->id == $model->moderator_id;
    $dt = new DateTime($model->scheduled_for);
    $user_friendly_date = $dt->format("m/d/Y h:i:s a");

    $html = "
        <div id='mbox-$model->id' class='mbox info'>
            <p>%DATE%</p>
            <hr>
            %PARTICIPANTS%
            <hr>
            <p><span>Notes:</span>%NOTE%</p>
            <hr>
            " .
        CHtml::link('Join Now', $this->createAbsoluteUrl('videoConference/join/' . $model->id, array(), 'https'), array('role' => "button", "class" => "btn btn-primary"));

    if ($ismoderator) {
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
    }

    $html .= "</div>";
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




    <?php
/*
    echo CHtml::link('Join Now', $this->createAbsoluteUrl('videoConference/join/' . $model->id, array(), 'https'));
*/
    ?>