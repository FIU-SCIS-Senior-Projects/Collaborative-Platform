<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */

$this->breadcrumbs = array(
    'Video Conferences' => array('index'),
    $model->id,
);

?>

<?php /*

$this->menu = array(
    array('label' => 'List VideoConference', 'url' => array('index')),
    array('label' => 'Create VideoConference', 'url' => array('create')),
    array('label' => 'Update VideoConference', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete VideoConference', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage VideoConference', 'url' => array('admin')),
);
?>

<h1>View VideoConference #<?php echo $model->id; ?></h1>









<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'moderator_id',
		'scheduled_on',
		'scheduled_for',
		'notes',
	),
)); ?>
*/ ?>


<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/fontawesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/theme.css">




<div class="container">





    <hr />
    <button id="open-room">Open Room</button>
    <!-- The meeting initiator -->
    <button id="join-room">Join Room</button>
    <!-- The meeting participants join-->
    <hr />



    <div class="page-header">
        <h1>Collaborative Tools</h1>
    </div>

    <div class="row">
        <div class="col-md-10">

            <div  id="cotools-panel">
                <div class="tab-filler">
                    <h2>Collaborative Panel</h2>
                </div>


            </div>

        </div>


        <div class="col-md-2">
            <!-- required for floating -->
            <!-- Nav tabs -->
            <div id="tool-box">
                <h4>Tool Box</h4>
                <table>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip" data-placement="top" title="Draw"><i class="fa fa-paint-brush"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip" data-placement="top" title="Erase"><i class="fa fa-eraser"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip" data-placement="top" title="Clear All"><i class="fa fa-recycle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip" id="share-screen" data-placement="top" title="Share Screen"><i class="fa fa-slideshare"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip" id="stop-share-screen" data-placement="top" title="Stop Sharing"><i class="fa fa-stop"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip" data-placement="top" title="Settings"><i class="fa fa-sliders"></i>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <button id="disconnect" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Settings">Disconnect</button>
        </div>
    </div>


    <h3> Participants </h3>
    <div id="video-container" class="row"> </div>



</div>
<!-- end of container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/bootstrap.min.js"></script>
<script type='text/javascript' src="https://cdn.webrtc-experiment.com/RTCMultiConnection.js"></script>

<script>
    // https://github.com/muaz-khan/RTCMultiConnection#1-link-the-library

    var rmc = new RTCMultiConnection();
    rmc.body = document.getElementById('video-container');
    // http://www.rtcmulticonnection.org/docs/#getExternalIceServers
    rmc.getExternalIceServers = false;
    document.getElementById('open-room').onclick = function() {
        // http://www.rtcmulticonnection.org/docs/open/
        rmc.open();
    };
    document.getElementById('join-room').onclick = function() {
        // http://www.rtcmulticonnection.org/docs/connect/
        rmc.connect();
    };
    rmc.onMediaCaptured = function() {
        document.getElementById('share-screen').disabled = false;
        document.getElementById('open-room').disabled = true;
        document.getElementById('join-room').disabled = true;
    };
    document.getElementById('share-screen').onclick = function() {
        // http://www.rtcmulticonnection.org/docs/addStream/
        rmc.addStream({
            screen: true,
            oneway: true
        });
        //document.getElementById('recordScreen').disabled = false;
    };


    //when the user clicsk the stop-share-screen button it removes all the screen
    document.getElementById('stop-share-screen').onclick = function(){
        rmc.removeStream('screen');
    };


    document.getElementById('disconnect').onclick = function(){
        rmc.disconnect();
    }

    /*
     //to know the stream type
     rmc.onstream = function(e){

     if(e.type == 'local'){
     alert("the stream is local");
     }
     if(e.type == 'remote'){
     alert("the stream is remote");
     }
     if(e.isVideo){
     alert("new video");
     document.getElementById('video-container').appendChild(e.mediaElement);
     }
     if(e.isAudio){
     document.getElementById('video-container').appendChild(e.mediaElement);
     }
     if(e.isScreen){
     alert("new screen");
     }
     };
     */
</script>


<!-- General Site Scripts -->
<script>
    $(function () { $('[data-toggle="tooltip"]').tooltip() });
</script>