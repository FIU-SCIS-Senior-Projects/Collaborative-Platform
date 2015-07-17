<?php
/**
 * Created by PhpStorm.
 * User: Mandy
 * Date: 7/13/15
 * Time: 7:24 PM
 */
?>

<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */

$this->breadcrumbs=array(
    'Video Conferences'=>array('index'),
    'View Deleted',
);

$this->menu=array(
    array('label'=>'List VideoConference', 'url'=>array('index')),
    array('label'=>'Create VideoConference', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#video-conference-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Deleted Video Conferences</h2>

<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div><!-- search-form -->

<?php
$model = VideoConference::model();
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'video-conference-grid',
    'dataProvider'=>$model->searchDeleted(User::getCurrentUserId()),
    'filter'=>$model,
    'columns'=>array(
//        'id::Video Conference Id',
        'subject',
        array('name'=>'moderator','value'=>'$data->getVCModerator()'),
        //'user.fname',
        //'moderator_id',
        'scheduled_on',
        'scheduled_for',
        'notes',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>



<?php
///* @var $this VideoConferenceController */
///* @var $meetingsId array */
//
//function accept($vcid){
//    return CHtml::ajaxLink('Accept',
//        Yii::app()->createAbsoluteUrl('videoConference/accept/'.$vcid),
//        array(
//            'type'=>'get',
//            'data' => array('id' =>$vcid,'type'=>'get'),
//            'update'=>'message',
//            'success' => 'function(response) {
//                                $(".message").html(response);
//                                location.reload();
//                                }',
//        ),
//        array( 'confirm'=>'Are you sure you want to accept this invitation?', 'role' => "button", "class" => "btn btn-success")
//    );
//}
//
//function reject($vcid){
//    return CHtml::ajaxLink('Reject',
//        Yii::app()->createAbsoluteUrl('videoConference/reject/'.$vcid),
//        array(
//            'type'=>'get',
//            'data' => array('id' =>$vcid,'type'=>'get'),
//            'update'=>'message',
//            'success' => 'function(response) {
//                                $(".message").html(response);
//                                location.reload();
//                                }',
//        ),
//        array( 'confirm'=>'Are you sure you want to reject this invitation?', 'role' => "button", "class" => "btn btn-danger")
//    );
//}
//
//
//
//$this->breadcrumbs=array(
//    'Video Conferences',
//);
//
////array('label'=>'Manage VideoConference', 'url'=>array('admin')),
//$this->menu=array(
//    array('label'=>'Create VideoConference', 'url'=>array('create')),
//    array('label'=>'View Deleted Video Conferences', 'url'=>array('viewDeleted'))
//);
//
//?>
<!---->
<!---->
<!--<style>-->
<!---->
<!--    div.mbox{-->
<!--        width: 500px;-->
<!--        padding: 15px;-->
<!--        margin-bottom: 15px;-->
<!--        border-radius: 4px;-->
<!--    }-->
<!--    .mbox p{-->
<!--        margin: 0px 0px 0px;-->
<!--    }-->
<!--    a.mbox{-->
<!--        color: #31708f;-->
<!--    }-->
<!---->
<!--    .mbox span{-->
<!--        font-weight: bold;-->
<!--        margin-right: 6px;-->
<!--    }-->
<!---->
<!--    .mbox ul{-->
<!--        margin: 0;-->
<!--    }-->
<!---->
<!--    .mbox hr{-->
<!--        border-top: 1px solid #19536c;-->
<!--        border-bottom: 0px;-->
<!--        margin: 5px 0px;-->
<!--    }-->
<!--    .ui-tooltip{-->
<!--        padding: 3px;-->
<!--        font-size: smaller;-->
<!--    }-->
<!---->
<!--    .mbox button, .mbox .btn{-->
<!--        padding: 2px 4px;-->
<!--        font-size: small;-->
<!--        margin-right: 4px;-->
<!--    }-->
<!---->
<!--    .cancelled{-->
<!--        background-color: #f4ffbc;-->
<!--    }-->
<!--    .scheduled{-->
<!--        background-color: #d9edf7;-->
<!--    }-->
<!---->
<!--</style>-->
<!---->
<!---->
<!---->
<!--<!---->-->
<!--<!--<h2><br>Past Video Conferences</h2>-->-->
<!--<!---->-->
<!--<!---->-->
<!--<!---->-->
<?php ////if (Yii::app()->user->hasFlash('invitation-error')): ?>
<!--<!--    <h3>There were some problems with your invitations: </h3>-->-->
<!--<!--    <div class="error-message">-->-->
<!--<!--        -->--><?php ////echo Yii::app()->user->getFlash('invitation-error'); ?>
<!--<!--    </div>-->-->
<?php ////endif; ?>
<!--<!---->-->
<!--<!---->-->
<!--<!---->-->
<?php
////$user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
////$vcs = VideoConference::model()->findAllByPk($meetingsId, array("order" => "scheduled_for DESC"));
////$past =  array();
////
////
////$today = new DateTime();
////foreach($vcs as $vc){
////    if($vc->status != 'deleted') {
////        $dt = new DateTime($vc->scheduled_for);
////
////
////        if ($dt->format('Y-m-d') < $today->format('Y-m-d')) {
////            array_push($past, $vc);
////        }
////    }
////}
////
//////    printVCS($todays,$user);
//////    printVCS($futures,$user);
//////    printVCS($past,$user);
////?>
<!--<!---->-->
<!--<!---->-->
<?php
////foreach($past as $vc){
////    $ismoderator  = $user->id == $vc->moderator_id;
////    $dt = new DateTime($vc->scheduled_for);
////    $user_friendly_date = $dt->format("m/d/Y h:i A");
////
////    $html = "
////        <div id='mbox-$vc->id' class='mbox info %MSTATUS%'> " .
////        CHtml::link($vc->subject, array('videoConference/' . $vc->id)) . "
////             %STATUS%
////            <p>%DATE%</p>
////            <hr>
////            %PARTICIPANTS%
////            <hr>
////            <p><span>Notes:</span>%NOTE%</p>
////            <hr>
////            ".
////        CHtml::link('Join Now', $this->createAbsoluteUrl('videoConference/join/' . $vc->id ,array(),'https'), array('role' => "button", "class" => "btn btn-primary"));
////
////    if($ismoderator){
////        $html .=   CHtml::ajaxLink('Delete',
////            Yii::app()->createAbsoluteUrl('videoConference/delete/'.$vc->id),
////            array(
////                'type'=>'post',
////                'data' => array('id' =>$vc->id,'type'=>'delete'),
////                'update'=>'message',
////                'success' => 'function(response) {
////                                $(".message").html(response);
////                                $("#mbox-'.$vc->id .'").remove();
////                                }',
////            ),
////            array( 'confirm'=>'Are you sure you want to delete this conference?', "visible" =>  $ismoderator, 'role' => "button", "class" => "btn btn-danger")
////        );
////        if($vc->status != "cancelled")
////            $html .=   CHtml::ajaxLink('Cancel',
////                Yii::app()->createAbsoluteUrl('videoConference/cancel/'.$vc->id),
////                array(
////                    'type'=>'post',
////                    'data' => array('id' =>$vc->id,'type'=>'delete'),
////                    'update'=>'message',
////                    'success' => 'function(response) {
////                                $(".message").html(response);
////                                location.reload();
////                                }',
////                ),
////                array( 'confirm'=>'Are you sure you want to cancel this conference?', "visible" =>  $ismoderator, 'role' => "button", "class" => "btn btn-warning")
////            );
////    }else{
////        $invitation = VCInvitation::model()->findByAttributes(array('videoconference_id' => $vc->id, 'invitee_id' => $user->id));
////        if($invitation->status == "Unknown"){
////            $html .= accept($vc->id);
////            $html .= reject($vc->id);
////        }else if($invitation->status == "Accepted"){
////            $html .= reject($vc->id);
////        }else{
////            $html .= accept($vc->id);
////        }
////
////    }
////
////
////
////    $html .=  "</div>";
////    $html = str_replace("%MSTATUS%", $vc->status, $html);
////
////    $html = str_replace("%MSTATUS%", $vc->status, $html);
////    if($vc->status == "cancelled"){
////        $html = str_replace("%STATUS%", "<p style='font-weight: bold'>Status: Cancelled</p>", $html);
////    }else{
////        $html = str_replace("%STATUS%", "", $html);
////    }
////    $html = str_replace("%SUBJECT%", $vc->subject, $html);
////    $html = str_replace("%DATE%", $user_friendly_date, $html);
////    $html = str_replace("%NOTE%", $vc->notes, $html);
////    $html = str_replace("%PARTICIPANTS%", $vc->findParticipantsHTMLList(), $html);
////
////    echo $html;
////}
////
////
////?>
<!--<!---->-->