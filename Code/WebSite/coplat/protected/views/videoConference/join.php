<?php
/**
 * Created by PhpStorm.
 * User: jtraviesor
 * Date: 2/25/15
 * Time: 2:51 AM
 */

/* @var $this VideoConferenceController */
/* @var $model VideoConference */

?>
<script>
    //https://gist.github.com/mathiasbynens/298591
    $.fn.toggleAttr = function(attr, attr1, attr2) {
        return this.each(function() {
            var self = $(this);
            if (self.attr(attr) == attr1)
                self.attr(attr, attr2);
            else
                self.attr(attr, attr1);
        });
    };
</script>


<!-- Init Site Scripts -->
<script>
    //hack bootstrap 2 to 3
    $('.span9').removeClass('span9');
    $('#page').removeClass('container');
    $('.span3').removeClass('span3');
    $('.dropdown').click(function(){
       $(this).toggleClass('open');
    });
    //$('div.btn-group').click(function(){
        //$(this).parent().toggleClass('open');
   //     $(this).child().toggleAttr('aria-expanded', true, false);
   // });
</script>


<div class="container">
<ol class="breadcrumb">
    <li><a href="/coplat/index.php">Home</a></li>
    <li><a href="/coplat/index.php/videoConference/index">Video Conferences</a></li>
    <li><a href="/coplat/index.php/videoConference/<?php echo $model->id; ?>"><?php echo $model->id; ?></a></li>
    <li class="active">Join</li>
</ol>
</div>





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
<div style="text-align: center;margin: 0 auto;">
<?php

$user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));

if ($user->id == $model->moderator_id) {
    echo
    " <!-- The meeting initiator -->
    <button type='button' class='btn btn-success' id='open-room'><i class='fa fa-key'></i>&nbsp;&nbsp;Open Room</button> ";
} else {
    echo
    "<!-- The meeting participants join-->
    <button type='button' class='btn btn-success' id='join-room'><i class='fa fa-users'></i>&nbsp;&nbsp;Join Room</button>
    ";
}

?>

<!--
<button type='button' class='btn btn-primary' id="show-whiteboard"><i class="fa fa-paint-brush"></i>&nbsp;&nbsp;Whiteboard</button>
<button type='button' class='btn btn-primary' id='reset-whiteboard'><i class="fa fa-recycle"></i>&nbsp;&nbsp;Clear Whiteboard</button>
<button type='button' class='btn btn-primary' id='share-screen'><i class="fa fa-desktop"></i>&nbsp;&nbsp;Share Screen</button>
<button type='button' class='btn btn-primary' id='stop-share-screen'><i class="fa fa-stop"></i>&nbsp;&nbsp;Stop Sharing</button>
<button type='button' class='btn btn-primary' id='settings'><i class="fa fa-sliders"></i>&nbsp;&nbsp;Settings</button>
<button type='button' class='btn btn-danger' id='disconnect'><i class="fa fa-close"></i>&nbsp;&nbsp;Disconnect</button>
-->


    <!-- Single button -->
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-paint-brush"></i>&nbsp;&nbsp;Whiteboard <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a id='show-whiteboard' href="#"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Show</a></li>
            <li><a id='reset-whiteboard' href="#"><i class="fa fa-recycle"></i>&nbsp;&nbsp;Clear</a></li>
        </ul>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-desktop"></i>&nbsp;&nbsp;Screen Sharing <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a id='show-screens' href="#"><i class="fa fa-slideshare"></i>&nbsp;&nbsp;Show Screens</a></li>
            <li><a id='share-screen' href="#"><i class="fa fa-share"></i>&nbsp;&nbsp;Share Screen</a></li>
            <li><a id='stop-share-screen' href="#"><i class="fa fa-stop"></i>&nbsp;&nbsp;Stop Sharing</a></li>
        </ul>
    </div>
    <button type='button' class='btn btn-primary' id='settings'><i class="fa fa-sliders"></i>&nbsp;&nbsp;Settings</button>
    <button type='button' class='btn btn-danger' id='disconnect'><i class="fa fa-close"></i>&nbsp;&nbsp;Disconnect</button>




<!--
<div id="tool-box" class="list-group">
    <a href="#" id="init-whiteboard" class="list-group-item"><i class="fa fa-paint-brush"></i>&nbsp;&nbsp;Whiteboard</a>
    <a href="#" id="reset-whiteboard" class="list-group-item"><i class="fa fa-recycle"></i>&nbsp;&nbsp;Reset
        Board</a>
    <a href="#" id="share-screen" class="list-group-item"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Share
        Screen</a>
    <a href="#" id="stop-share-screen" class="list-group-item"><i class="fa fa-stop"></i>&nbsp;&nbsp;Stop
        Sharing</a>
    <a href="#" class="list-group-item"><i class="fa fa-sliders"></i>&nbsp;&nbsp;Settings</a>
    <a href="#" id="disconnect" class="list-group-item"><i
            class="fa fa-close"></i>&nbsp;&nbsp;Disconnect</a>
</div>

-->
</div>
<hr/>



<div class="container-fluid">

        <div class="row">

            <div id="video-container" style="" class="col-md-2 col-lg-3">

            </div>
            <div id="cotools-container" class="col-md-8 col-lg-6">
                <div id="cotools-panel">

                </div>

            </div>


            <div id="chat-container" class="col-md-2 col-lg-3">

                <input type=text id="input-text-chat" disabled>
                <div id="" class="row"></div>
            </div>


        </div>
    </section>
    <!-- end of row -->
</div>


<!--<div id="video-container"></div>-->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/bootstrap.min.js"></script>
<!-- Remote
<script type='text/javascript' src="https://cdn.webrtc-experiment.com/RTCMultiConnection.js"></script>
<script type='text/javascript' src="https://www.webrtc-experiment.com/Canvas-Designer/canvas-designer-widget.js"></script>
-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/RTCMultiConnection.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/canvas/canvas-designer-widget.js"></script>

<script>
    // https://github.com/muaz-khan/RTCMultiConnection#1-link-the-library

    var rmc = new RTCMultiConnection();
    rmc.body = document.getElementById('video-container');
    // http://www.rtcmulticonnection.org/docs/#getExternalIceServers
    rmc.userid = "<?php echo $user->fname . ' ' . $user->lname . ' (' . $user->username . ')' ; ?>";
    rmc.getExternalIceServers = false;
    rmc.session = {
        video: true,
        audio: true,
        data: true
    }


    $('#open-room').click(function () {
        // http://www.rtcmulticonnection.org/docs/open/
        rmc.open();
    });
    $('#join-room').click(function () {
        // http://www.rtcmulticonnection.org/docs/connect/
        rmc.connect();
    });

    rmc.onMediaCaptured = function () {
        $('#share-screen').removeAttr('disabled');
        $('#open-room').attr('disabled', 'disabled');
        $('#join-room').attr('disabled', 'disabled');
    };

    //screen sharing
    $('#share-screen').click(function () {
        // http://www.rtcmulticonnection.org/docs/addStream/

        rmc.removeStream('screen');
        rmc.addStream({
            screen: true,
            oneway: true
        });
    });
    //when the user clicks the stop-share-screen button it removes all the screen
    $('#stop-share-screen').click(function () {
        rmc.removeStream('screen');
        $('#cotools-panel iframe').show();
        $('#cotools-panel video').remove();
    });

    //chat
    rmc.onopen = function (event) {
        alert('Text chat has been opened between you and ' + event.userid);
        document.getElementById('input-text-chat').disabled = false;
    };

    document.getElementById('input-text-chat').onkeyup = function (e) {
        if (e.keyCode != 13) return; // if it is not Enter-key
        var value = this.value.replace(/^\s+|\s+$/g, '');
        if (!value.length) return; // if empty-spaces

        rmc.send({
            type: 'chat',
            content: value
        });
        this.value = '';
    };

    //end of chat


    $('#disconnect').click(function () {
        rmc.disconnect();
    });


    //to know the stream type
    rmc.onstream = function (e) {

        if (e.type == 'local') {
            // alert("the stream is local");
        }
        if (e.type == 'remote') {
            // alert("the stream is remote");
        }

        if (e.isVideo) {
            //alert("new video");
            var uibox = document.createElement("div");
            uibox.appendChild(document.createTextNode(e.userid));
            uibox.className = "userid";

            document.getElementById('video-container').appendChild(e.mediaElement);
            document.getElementById('video-container').appendChild(uibox);

        }
        else if (e.isAudio) {
            document.getElementById('video-container').appendChild(e.mediaElement);
        }
        else if (e.isScreen) {

            $('#cotools-panel iframe').hide();
            $('#cotools-panel video').remove();

            // $('#cotools-panel').html(e.mediaElement);
            document.getElementById('cotools-panel').appendChild(e.mediaElement);
            //alert("new screen");
        }

    };

    //receiving a message
    rmc.onmessage = function (event) {
        if (event.data.type == "chat") {
            alert('Target user (' + event.userid + ') said: ' + event.data.content);
        }
        else {

            CanvasDesigner.syncData(event.data);
        }
    };



    //Whiteboard Section

    function canvasInit() {

        CanvasDesigner.addSyncListener(function (data) {
            rmc.send(data);
        });
        CanvasDesigner.setSelected('pencil');
        CanvasDesigner.setTools({
            pencil: true,
            text: true,
            eraser: true
        });
        CanvasDesigner.appendTo(document.getElementById('cotools-panel'));
    }
    canvasInit();


    $("#reset-whiteboard").click(function () {
        $('#cotools-panel iframe').remove();
        $('#cotools-panel video').hide();
        canvasInit();
    });

    $("#show-whiteboard").click(function () {
        $('#cotools-panel video').hide();
        $('#cotools-panel iframe').show();
    });

    $("#show-screens").click(function () {
        $('#cotools-panel video').show();
        $('#cotools-panel iframe').hide();
    });


    /*
     Array.prototype.slice.call(document.getElementById('action-controls').querySelectorAll('input[type=checkbox]')).forEach(function(checkbox) {
     checkbox.onchange = function() {
     CanvasDesigner.destroy();

     CanvasDesigner.addSyncListener(function(data) {
     connection.send(data);
     });

     var tools = {};
     Array.prototype.slice.call(document.getElementById('action-controls').querySelectorAll('input[type=checkbox]')).forEach(function(checkbox2) {
     if(checkbox2.checked) {
     tools[checkbox2.id] = true;
     }
     });
     CanvasDesigner.setTools(tools);
     CanvasDesigner.appendTo(document.getElementById('cotools-panel'));
     };
     });

     */
</script>


<!-- General Site Scripts -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('.dropdown-toggle').dropdown();
</script>







