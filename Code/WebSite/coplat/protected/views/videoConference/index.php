<?php
/* @var $this VideoConferenceController */
/* @var $meetingsId array */



///* @var $dataProvider CActiveDataProvider */



$this->breadcrumbs=array(
	'Video Conferences',
);

$this->menu=array(
	array('label'=>'Create VideoConference', 'url'=>array('create')),
	array('label'=>'Manage VideoConference', 'url'=>array('admin')),
);

?>


<style>

    div.mbox{
        width: 500px;
        padding: 15px;
        background-color: #d9edf7;
        margin-bottom: 15px;
        border-radius: 4px;
    }
    .mbox p{
        margin: 0px 0px 0px;
    }
    a.mbox{
        color: #31708f;
    }

    .mbox span{
        font-weight: bold;
        margin-right: 6px;
    }

    .mbox ul{
        margin: 0;
    }

    .mbox hr{
        border-top: 1px solid #19536c;
        border-bottom: 0px;
        margin: 5px 0px;
    }
    .ui-tooltip{
       padding: 3px;
       font-size: smaller;
    }

</style>




<h1>Video Conferences</h1>







<?php


    $user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
    $vcs = VideoConference::model()->findAllByPk($meetingsId);

// <!--<a href='../videoConference/%ID%'>%SUBJECT%</a> -->



    foreach($vcs as $vc){
        $ismoderator  = $user->id == $vc->moderator_id;
        $dt = new DateTime($vc->scheduled_for);
        $user_friendly_date = $dt->format("m/d/Y h:i:s a");

        $html = "
        <div id='mbox-$vc->id' class='mbox info'> " .
            CHtml::link($vc->subject, array('videoConference/' . $vc->id)) . "
            <p>%DATE%</p>
            <hr>
            %PARTICIPANTS%
            <hr>
            <p><span>Notes:</span>%NOTE%</p>
            <hr>
            ".
            CHtml::link('Join Now', $this->createAbsoluteUrl('videoConference/join/' . $vc->id ,array(),'https'), array('role' => "button", "class" => "btn btn-primary"));

            if($ismoderator){
                $html .=   CHtml::ajaxLink('Delete',
                    Yii::app()->createAbsoluteUrl('videoConference/delete/'.$vc->id),
                    array(
                        'type'=>'post',
                        'data' => array('id' =>$vc->id,'type'=>'delete'),
                        'update'=>'message',
                        'success' => 'function(response) {
                                $(".message").html(response);
                                $("#mbox-'.$vc->id .'").remove();
                                }',
                    ),
                    array( 'confirm'=>'Are you sure you want to delete this conference?', "visible" =>  $ismoderator, 'role' => "button", "class" => "btn btn-danger")
                );
            }

            $html .=  "</div>";






      //  $html = str_replace("%ID%", $vc->id, $html);
        $html = str_replace("%SUBJECT%", $vc->subject, $html);
        $html = str_replace("%DATE%", $user_friendly_date, $html);
        $html = str_replace("%NOTE%", $vc->notes, $html);
        $html = str_replace("%PARTICIPANTS%", $vc->findParticipantsHTMLList(), $html);

        echo $html;
    }
?>

<!--
<script>
    function ajaxGeneric(action, method, params, response_target) {
        var infoBox = $(response_target);
        var postAction = "";
        console.log(params);
        $.ajax({
            type : method,
            url : action,
            data : params,
            success : function(response) {
                //postAction = response.action;
                infoBox.html(response);
            }
        }).done(function() {

        }).fail(function() {

        });
    }


    $(document).ready(function() {
        $('.delete-btn').click(function(event) {
            var method = 'POST';
            var action = 'delete';

            var pos = $(this).attr('id').indexOf("-");
            var id = $(this).attr('id').substring(pos + 1);
            var data = {'id' : id};

            ajaxGeneric(action, method, data, "#message_box");
            event.preventDefault(); // Prevent the form from submitting via the browser.
        });
    });
</script>
-->




<?php
/*
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
*/
?>
