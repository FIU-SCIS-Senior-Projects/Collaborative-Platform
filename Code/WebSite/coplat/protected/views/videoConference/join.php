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
    $.fn.toggleAttr = function (attr, attr1, attr2) {
        return this.each(function () {
            var self = $(this);
            if (self.attr(attr) == attr1)
                self.attr(attr, attr2);
            else
                self.attr(attr, attr1);
        });
    };
</script>
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
</script>


<!-- Init Site Scripts -->
<script>
    //hack bootstrap 2 to 3
    $('.span9').removeClass('span9');
    $('#page').removeClass('container');
    $('.span3').removeClass('span3');
    $('.dropdown').click(function () {
        $(this).toggleClass('open');
    });
    $(document).ready(function () {
        var link = $("#select-screen-plugin");
        if (navigator.userAgent.indexOf("Chrome") != -1) {
            link.attr("href", "https://chrome.google.com/webstore/detail/ajhifddimkapgcifgcodmmfdlknahffk");
        }
        else if (navigator.userAgent.indexOf("Firefox") != -1) {
            link.attr("href", "https://www.webrtc-experiment.com/store/firefox-extension/enable-screen-capturing.xpi");
        }
        else {
            alert("The browser you are using is unsupported. Please use Google Chrome");
        }

    });


</script>


<!-- Bootstrap -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/theme.css">
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/style.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


<div style="text-align: center;margin: 0 auto;">
    <?php
    $user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
    if ($user->id == $model->moderator_id) {
        echo
        " <!-- The meeting initiator -->
        <button title='Click here to start the meeting' type='button' class='btn btn-success' id='open-room'><i class='fa fa-key'></i>&nbsp;&nbsp;Open Room</button> ";
    } else {
        echo
        "<!-- The meeting participants join-->
        <button title='Click here to join the meeting' type='button' class='btn btn-success' id='join-room'><i class='fa fa-users'></i>&nbsp;&nbsp;Join Room</button>
        ";
    }
    ?>


    <!-- Single button -->
    <div class="btn-group">
        <button type="button" title="Whiteboard actions" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                aria-expanded="false">
            <i class="fa fa-paint-brush"></i>&nbsp;&nbsp;Whiteboard <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a id='show-whiteboard' title="Show the whiteboard" href="#"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Show</a>
            </li>
            <li><a id='reset-whiteboard' title="Clear the whiteboard" href="#"><i class="fa fa-recycle"></i>&nbsp;&nbsp;Clear</a>
            </li>
        </ul>
    </div>
    <div class="btn-group">
        <button type="button" title="Screen sharing actions" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-desktop"></i>&nbsp;&nbsp;Screen Sharing <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a id='select-screen-plugin' target="_blank" href="#"><i class="fa fa-external-link"></i>&nbsp;&nbsp;Plugin</a>
            </li>
            <li><a id='show-screens' href="#"><i class="fa fa-slideshare"></i>&nbsp;&nbsp;Show Screens</a></li>
            <li><a id='share-screen' href="#"><i class="fa fa-share"></i>&nbsp;&nbsp;Share Screen</a></li>
            <li><a id='stop-share-screen' href="#"><i class="fa fa-stop"></i>&nbsp;&nbsp;Stop Sharing</a></li>
        </ul>
    </div>
    <div class="btn-group">
        <button type="button" title="Application settings" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-sliders"></i>&nbsp;&nbsp;Settings <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a id='invite-user' rel="leanModal" name="invite" title="Invite people to the meeting" href="#invite" href="#"><i class="fa fa-plus"></i>&nbsp;&nbsp;Invite
                    People</a></li>
        </ul>
    </div>
<!--    <button type='button' title="Present" class='btn btn-primary' id='present'><i class="fa fa-share"></i>&nbsp;&nbsp;Present</button>-->
    <button type='button' title="Leave the room" class='btn btn-danger' id='disconnect'><i class="fa fa-close"></i>&nbsp;&nbsp;Leave
    </button>


</div>
<hr/>


<div class="container-fluid">


    <div class="row">
        <div id="cotools-container" class="col-md-6 col-lg-6">
            <div id="cotools-panel">

            </div>

        </div>

        <div id="cotools-container-2" class="col-md-6 col-lg-6">
            <div id="cotools-panel-2">

            </div>

        </div>

    </div>
    <div class="row row-fluid">
        <div id="video-container" style="" class="col-md-2 col-lg-2">

            <div style="margin-left: 80px" >
                <?php echo '<i onclick="pauseResumeVideo()" class="fa fa-video-camera" style="color: #FFF" id="on-off-video"></i>'?>
            </div>

        </div>


        <div id="live-chat">
            <header class="clearfix">
                <h4><?php echo $user->fname . ' ' .$user->lname .' ('. $user->username .')'?></h4>
                <span class="chat-message-counter" id="count"></span>
            </header>

            <div class="chat">
                <div class="chat-history" id="chat-h">
                    <p>Welcome to the chat room!</p>
                </div> <!-- end chat-history -->
                <textarea id="input-text-area" type="text" placeholder="Type your message..." disabled></textarea>
                <input type="hidden">
            </div> <!-- end chat -->
        </div> <!-- end live-chat -->
        
    </div>
<!--    </section>-->
    <!-- end of row -->
</div>

<div id="invite">
    <div id="invite-ct">
        <div id="invite-header">
            <h3>Invite People</h3>
            <small>Invite more people to the meeting</small>
            <a class="modal_close" href="#"></a>
        </div >
        <div id="message_box" style="padding: 10px;">

        </div>
        <form id="invitation-form" class="form-horizontal" method="get" action="../invite">
            <input name="meeting-id" type="hidden" value="<?php echo $model->id ?>" id="meetingID">
            <div class="invitee_emails">
                <div class="form-group">
                        <label class="control-label col-md-2" for="invitee-1">Email 1</label>
                        <div class="col-md-8">
                            <input placeholder="Invitee email" class="form-control" id="invitee-1" type="email" name="invitees[]">
                            <a href="#" class="add_field_button">&nbsp;&nbsp;<i class="fa fa-plus"></i></a>
                        </div>

                </div>
            </div>
            <button type="submit" class="btn btn-success">OK</button>
        </form>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/jquery.1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/bootstrap.min.js"></script>

<script type='text/javascript' src="https://cdn.webrtc-experiment.com/RTCMultiConnection.js"></script>
<script type='text/javascript' src="https://www.webrtc-experiment.com/Canvas-Designer/canvas-designer-widget.js"></script>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/RTCMultiConnection.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/firebase.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/canvas/canvas-designer-widget.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/js/jquery.leanModal.min.js"></script>
<script type='text/javascript' src="https://cdn.WebRTC-Experiment.com/getScreenId.js"></script>

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/cotools/css/style.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">


<script>
    // https://github.com/muaz-khan/RTCMultiConnection

    var rmc = new RTCMultiConnection();

    rmc.userid = "<?php echo $user->fname . ' ' . $user->lname . ' (' . $user->username . ')' ; ?>";
    rmc.session = {
        video: true,
        audio: true,
        data: true
    };



    $('#open-room').click(function () {
        // http://www.rtcmulticonnection.org/docs/open/
        rmc.open();
        rmc.onCustomMessage = function(message) {
            Ri = message;
        };
    });

    $('#join-room').click(function () {
        document.getElementById("join-room").disabled = true;
        document.getElementById("join-room").innerHTML = 'Waiting for organizer...'

        // http://www.rtcmulticonnection.org/docs/connect/
        rmc.connect();
        rmc.onCustomMessage = function(message) {
            Ri = message;
        };
    });

    var video_status = 0;

    function pauseResumeVideo() {
        if(video_status == 0) {
            document.getElementById("on-off-video").style.color= 'gray';
            rmc.streams.selectFirst({local : true}).mute({video : true});
            video_status = 1;
        }
        else if(video_status == 1) {
            document.getElementById("on-off-video").style.color= "red";
            rmc.streams.selectFirst({local : true}).unmute({video : true});
            video_status = 0;
        }

    }

    rmc.onmute = function(e) {
       e.mediaElement.setAttribute('poster', '/coplat/images/black.png');
    };

    rmc.onunmute = function(e) {
       e.mediaElement.removeAttribute('poster');
    };

    // display a notification box
    window.addEventListener('beforeunload', function () {
        return 'Do you want to leave?';
    }, false);

    // leave here
    window.addEventListener('unload', function () {
        rmc.leave();
    }, true);

    rmc.onMediaCaptured = function () {
        $('#share-screen').removeAttr('disabled');
        $('#open-room').attr('disabled', 'disabled');
        $('#join-room').attr('disabled', 'disabled');
    };

    //screen sharing
    $('#share-screen').click(function () {
        rmc.streams.stop('screen');
        $('#cotools-panel video').remove();
        rmc.keepStreamsOpened = true;

        // http://www.rtcmulticonnection.org/docs/addStream/
        rmc.addStream({
            //data: true,
            video: false,
            screen: true,
            oneway: true
        });
//        this.streamid = "999";
//        alert("Before:"+ this.streamid);
    });


    //when the user clicks the stop-share-screen button it removes all the screen
    $('#stop-share-screen').click(function () {
        $('#cotools-panel video').remove();
        $('#cotools-panel iframe').show();
    });

    //chat
    rmc.onopen = function (event) {
        document.getElementById('input-text-area').disabled = false;
    };

   document.getElementById('input-text-area').onkeyup = function (e) {
       if (e.keyCode != 13) return; // if it is not Enter-key
       var value = this.value.replace(/^\s+|\s+$/g, '');
       if (!value.length) return; // if empty-spaces
       appendMsg("You", value);
       rmc.send({
           type: 'chat',
           content: value
       });
       this.value = '';
   };

    $('#disconnect').click(function () {
        rmc.leave();
        setTimeout("location.href = '../';",1000);
    });

    var presenter = 0;
    var Ri = "";
    //to know the stream type
    rmc.onstream = function (e) {
        if (e.type == 'local') {
            // alert("the stream is local");
        }
        if (e.type == 'remote') {
            // alert("the stream is remote");
        }
        if (e.isVideo || e.stream.isVideo) {
            var uibox = document.createElement("div");
            uibox.appendChild(document.createTextNode(e.userid));

//            if(rmc.DetectRTC.hasWebcam) {
//                //alert("user does not have a webcam");
//                //e.mediaElement.setAttribute('poster', '/coplat/images/noWebcam.jpeg');
//            }

            uibox.appendChild(e.mediaElement);
            uibox.className = "userid";
            uibox.id = "uibox-" + e.userid.replace(/ |\(|\)/g, '');
            uibox.style.cssText = 'float: left';
            e.mediaElement.style.cssText = 'display: block';
            document.getElementById('video-container').appendChild(uibox);
            document.getElementById("on-off-video").style.color= 'red';
            $('#join-room').fadeOut(600);
            if(!rmc.DetectRTC.hasWebcam) {
                alert((<?php echo $user->fname . ' ' .$user->lname .' ('. $user->username .')'?>).replace(/ |\(|\)/g, '') + "\n" + e.userid.replace(/ |\(|\)/g, ''));
                $('#uibox-' + <?php echo $user->id ?>).prepend('<img id="nwcImage" src="/coplat/images/noWebcam.png" />');
            }
//            alert(e.streamid);
        }
        else if (e.isAudio) {
            document.getElementById('video-container').appendChild(e.mediaElement);
        }
        else if (e.isScreen || e.stream.isScreen) {
            rmc.waitUntilRemoteStreamStartsFlowing = true;
            console.log("************************ Stream Type: SCREEN - From: " + e.userid + " ******************************");
//            screens[i] = e;
//            i++;
            handleStreams(e);

        }

    };

    function handleStreams(e) {
        if(!document.getElementById('cotools-panel-2').getAttribute('has-screen')) {
            if (Ri == "") {
                document.getElementById('cotools-panel-2').setAttribute('has-screen', true);
                document.getElementById('cotools-panel-2').appendChild(e.mediaElement);
                rmc.sendCustomMessage(e.streamid);
            }
            else {
                if(e.streamid == Ri) {
//                    alert("Stream ids are equal");
                    document.getElementById('cotools-panel-2').appendChild(e.mediaElement);
                }
                else {
//                    alert("ids are NOT equal");
                    $('#cotools-panel iframe').hide();
                    $('#cotools-panel video').remove();
                    document.getElementById('cotools-panel').appendChild(e.mediaElement);
                }
            }
        }
        else {
            $('#cotools-panel iframe').hide();
            $('#cotools-panel video').remove();
            document.getElementById('cotools-panel').appendChild(e.mediaElement);
        }
    }

    //receiving a message from
    var messages = 0;
    rmc.onmessage = function (event) {
        if (event.data.type == "chat") {
            var username = event.userid;
            username = username.substring(username.indexOf('(')+1, username.indexOf(')'));
            appendMsg(username, event.data.content);
            if(!open) {
                messages++;
                $('#count').text(messages);
                $('.chat-message-counter').show();
            }
        }
        else {

            CanvasDesigner.syncData(event.data);
        }
    };

    function appendMsg(user, msg) {
        var $cont = $("#chat-h");
        $cont[0].scrollTop = $cont[0].scrollHeight;
        $cont.append("<p class='msg' id='chat-p'><span>" + user + ":  </span> " + msg + " </p>");
    }


    //removes the div containing the userid of the user who is leaving
    rmc.onleave = function (e) {
        $('#' + "uibox-" + e.userid.replace(/ |\(|\)/g, '')).remove();
        Ri = "";
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

</script>


<!-- General Site Scripts -->
<script>
    var open = false;
    $('#live-chat header').on('click', function() {

        $('.chat').slideToggle(300, 'swing');
        $('.chat-message-counter').fadeOut(300);
        messages = 0;
        if(open) {
            open = false;
        } else {
            open = true;
        }
    });

    $(function () {
        $('[data-toggle="uitooltip"]').tooltip()
    });

    $('.dropdown-toggle').dropdown();

    $(function () {
        $('a[rel*=leanModal]').leanModal({top: 200, closeButton: ".modal_close"});
    });


    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".invitee_emails"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-group">' +

                            '<label class="control-label col-md-2" for="invitee-'+x+'">Email ' + x + '</label>' +
                            ' <div class="col-md-8">'+
                            '<input placeholder="" type="email" class="form-control" id="invitee-' + x + '" name="invitees[]"/>' +
                            '<a href="#" class="remove_field">&nbsp;&nbsp;<i class="fa fa-times"></i></a>' +
                            '</div>' +
                    '</div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.chat').slideToggle(1, 'swing');
        $('#invitation-form').submit(function(event) {
            var form = $(this);
            var method = form.attr('method');
            var action = form.attr('action');
            var data = form.serialize();
            ajaxGeneric(action, method, data, "#message_box");
            setTimeout(closeModal, 5000);     //wait 5 seconds
            event.preventDefault(); // Prevent the form from submitting via the browser.
        });
    });
    function closeModal(){
        $('#lean_overlay').css('display', 'none');
        $('#invite').css('display', 'none');
    }
</script>



