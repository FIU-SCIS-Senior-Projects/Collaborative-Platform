<?php
/**
 * Created by PhpStorm.
 * User: jtraviesor
 * Date: 2/25/15
 * Time: 2:51 AM
 */

/* @var $this VideoConferenceController */
/* @var $model VideoConference */


$this->breadcrumbs = array(
    'Video Conferences' => array('index'),
    'Join',
    $model->id
);
?>



<!-- Init Site Scripts -->
<script>
    $(".span9:first").removeClass('span9');
</script>



<!-- Bootstrap -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
      href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/fontawesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/theme.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->






<hr/>
<button id="open-room">Open Room</button>
<!-- The meeting initiator -->
<button id="join-room">Join Room</button>
<!-- The meeting participants join-->
<hr/>


<div class="page-header">
    <h1>Collaborative Tools</h1>
</div>

<div class="row">
    <div class="col-md-10">

        <div id="cotools-panel">
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
                        <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip"
                                data-placement="top" title="Draw"><i class="fa fa-paint-brush"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip"
                                data-placement="top" title="Erase"><i class="fa fa-eraser"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip"
                                data-placement="top" title="Clear All"><i class="fa fa-recycle"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip"
                                id="share-screen" data-placement="top" title="Share Screen"><i
                                class="fa fa-slideshare"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip"
                                id="stop-share-screen" data-placement="top" title="Stop Sharing"><i
                                class="fa fa-stop"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary action-button shadow animate" data-toggle="tooltip"
                                data-placement="top" title="Settings"><i class="fa fa-sliders"></i>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
        <button id="disconnect" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top"
                title="Settings">Disconnect
        </button>
    </div>
</div>


<h3> Participants </h3>
<div id="video-container" class="row"></div>



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
    document.getElementById('open-room').onclick = function () {
        // http://www.rtcmulticonnection.org/docs/open/
        rmc.open();
    };
    document.getElementById('join-room').onclick = function () {
        // http://www.rtcmulticonnection.org/docs/connect/
        rmc.connect();
    };
    rmc.onMediaCaptured = function () {
        document.getElementById('share-screen').disabled = false;
        document.getElementById('open-room').disabled = true;
        document.getElementById('join-room').disabled = true;
    };
    document.getElementById('share-screen').onclick = function () {
        // http://www.rtcmulticonnection.org/docs/addStream/
        rmc.addStream({
            screen: true,
            oneway: true
        });
        //document.getElementById('recordScreen').disabled = false;
    };


    //when the user clicsk the stop-share-screen button it removes all the screen
    document.getElementById('stop-share-screen').onclick = function () {
        rmc.removeStream('screen');
    };


    document.getElementById('disconnect').onclick = function () {
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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>


</body>
<div style="height:50px;"></div>
<div
    style="position:fixed; text-align:center; width:100%; height:20px; background-color:white; border-top: 1px solid rgb(206, 206, 206); padding:5px; 		bottom:0px; ">
    <a target="blank" href="http://fiu.edu">Florida International University</a> | Collaborative Platform - Senior
    Project 2015
</div>
</html>