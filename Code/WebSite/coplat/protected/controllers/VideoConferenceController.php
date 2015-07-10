<?php ob_start();

class VideoConferenceController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    //public $layout='//layouts/videoconference';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'join', 'delete', 'invite', 'accept', 'reject', 'createfrommodal', 'cancel'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'cancel'),
                'users' => array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
        $invitation = VCInvitation::model()->findByAttributes(array("videoconference_id" => $id, "invitee_id" => $user->id));

        $meeting = VideoConference::model()->findByAttributes(array("id" => $id));


        //Yii::trace(CVarDumper::dumpAsString($invitation));

        if ($invitation || $meeting) {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        } else {
            $message = "You are not allowed to view this meeting's details";
            $this->render('notAllowed', array("message" => $message));
        }
    }

    /**
     * Lets user join the video conference room
     * @param integer $id the ID of the model to be displayed
     */

    public function actionJoin($id)
    {
        $user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
        $invitation = VCInvitation::model()->findByAttributes(array("videoconference_id" => $id, "invitee_id" => $user->id));
        $meeting = VideoConference::model()->findByAttributes(array("id" => $id));

        if ($invitation || $meeting) {
            $this->render('join', array(
                'model' => $this->loadModel($id),
            ));
        } else {
            $message = "You are not allowed to join this meeting";
            $this->render('notAllowed', array('message' => $message));
        }
    }


    /**
     * Schedules a new video conference
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new VideoConference;
        $invitationError = "";


        if (isset($_POST['VideoConference'])) {
            $model->attributes = $_POST['VideoConference'];             //get the rest of the attributes
            $moderator = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
            $model->moderator_id = $moderator->id;                      //get the current users id
            $model->scheduled_on = date("Y-m-d H:i:s");                 //now date

            $dateopt = $_POST['dateopt'];
            if ($dateopt == "now") {                                    //if scheduled for now, use now datetime
                $model->scheduled_for = date("Y-m-d H:i:s");
            } else if ($dateopt == "later") {                           //else get the date and validate it
                if (isset($_POST["date"]) && isset($_POST["time"])) {
                    $format = "m/d/Y H:i a";
                    $date = DateTime::createFromFormat($format, $_POST['date'] . "  " . strtolower($_POST['time']));
                    if (!$date) {
                        $model->addError('date', "Wrong format for the date and/or time ");
                        $this->render('create', array(
                            'model' => $model,
                        ));
                        exit;
                    } else {
                        $model->scheduled_for = $date->format("Y-m-d H:i:s");
                    }
                } else {
                    $model->addError('date', "Empty date or time");
                    $this->render('create', array(
                        'model' => $model,
                    ));
                    exit;
                }
            }

            if ($model->save()) {                       //if we can save the date
                $inviteeList = $_POST['invitees'];    //emails of all the invitees
                foreach($inviteeList as $username) {
                    if ($username != null) {
                        $lname = substr($username, 0, stripos($username, ","));
                        $fname = substr($username, stripos($username, ",") + 2);

                        $user = User::model()->findAllBySql("Select * from user where fname =:fnam AND lname =:lnam", array(":fnam" => $fname, ":lnam" => $lname));

                        foreach ($user as $invitee) {
                            $email = $invitee->email;

                            if ($email == null) {             //if invitee does not exist, record the error and continue
                                $invitationError .= $username . " does not appear in our records <br>";
                                continue;
                            }                                  //moderator cannot invite him/herself
                            if ($invitee->id == $moderator->id) {
                                continue;
                            }

                            $invitation = new VCInvitation();
                            $invitation->invitee_id = $invitee->id;
                            $invitation->videoconference_id = $model->id;
                            $invitation->status = "Unknown";

                            if (!$invitation->save()) {        //an error occurred
                                $invitationError .= "An error occurred upon saving the invitation to " . $username . "error";
                            } else {
                                $inviteefullName = $invitee->fname . " " . $invitee->lname;
                                VCInvitation::sendInvitationEmail($model, $inviteefullName, $email);;
                            }

                        }

                        if ($invitationError != "") {          //if there was an error
                            Yii::app()->user->setFlash('invitation-error', $invitationError);
                        }
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model fr
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateFromModal()
    {
        $model = new VideoConference;
        $invitationError = "";

        if (isset($_POST['VideoConference'])) {
            $model->attributes = $_POST['VideoConference'];             //get the rest of the attributes
            $moderator = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
            $model->moderator_id = $moderator->id;                      //get the current users id
            $model->scheduled_on = date("Y-m-d H:i:s");                 //now

            $dateopt = $_POST['dateopt'];
            if ($dateopt == "now") {
                $model->scheduled_for = date("Y-m-d H:i:s");
            } else if ($dateopt == "later") {
                if (isset($_POST["date"]) && isset($_POST["time"])) {
                    $format = "m/d/Y H:i a";
                    $date = DateTime::createFromFormat($format, $_POST['date'] . "  " . strtolower($_POST['time']));
                    if (!$date) {
                        print_r("Wrong format for the date ");
                        exit;
                    } else {
                        $model->scheduled_for = $date->format("Y-m-d H:i:s");
                    }
                } else {
                    print_r("Empty date or time");
                    exit;
                }


            }

            if ($model->save()) {
                print_r("OK");
                $inviteeEmails = $_POST['invitees']; // Returns an array
                foreach ($inviteeEmails as $email) {
                    $invitee = User::model()->findByAttributes(array('email' => $email));
                    if ($invitee == null) {
                        $invitationError .= $email . " does not appear in our records <br>";
                        continue;
                    }
                    if ($invitee->id == $moderator->id) {
                        continue;
                    }

                    $invitation = new VCInvitation();
                    $invitation->invitee_id = $invitee->id;
                    $invitation->videoconference_id = $model->id;
                    $invitation->status = "Unknown";
                    if (!$invitation->save()) {                                         //an error occurred
                        $invitationError .= "An error occurred upon saving the invitation to " . $email . "error";
                    } else {
                        $inviteefullName = $invitee->fname . " " . $invitee->lname;
                        VCInvitation::sendInvitationEmail($model, $inviteefullName, $email);;
                    }
                }
                if ($invitationError != "") {
                    Yii::app()->user->setFlash('invitation-error', $invitationError);
                }

            }

        }

    }

    /**
     * Add Participants Inside Video Conference Room. Works with an AJAX GET request with a list of all the emails as
     * parameters
     */

    public function actionInvite()
    {

        $message = "";
        $inviteeEmails = $_GET['invitees']; // Returns an array

        foreach ($inviteeEmails as $email) {
            $invitee = User::model()->findByAttributes(array('email' => $email));
            if ($invitee == null) {
                $message .= $email . " does not appear in our records <br>";
                continue;
            }

            if (isset($_GET['meeting-id'])) {
                $vc_id = $_GET['meeting-id'];
                $invitation = VCInvitation::model()->findByAttributes(array('videoconference_id' => $vc_id, 'invitee_id' => $invitee->id));
                if ($invitation == null) {

                    $invitation = new VCInvitation();
                    $invitation->invitee_id = $invitee->id;
                    $invitation->videoconference_id = $vc_id;
                    $invitation->status = "Maybe";
                    if (!$invitation->save()) {                                         //an error occurred
                        $message .= "An error occurred upon saving the invitation to " . $email . "error";
                    } else {

                        $inviteefullName = $invitee->fname . " " . $invitee->lname;
                        $vc = VideoConference::model()->findByAttributes(array("id" => $vc_id));
                        VCInvitation::sendInvitationEmail($vc, $inviteefullName, $email);;
                    }
                } else {
                    //print_r($invitation->invitee_id);
                    //print_r($invitation->videoconference_id);

                }
            }


        }

        if ($message == "") {
            $message = "The invitations have successfully been sent.";
        }
        print_r($message);

    }

    public function actionAccept($id)
    {

        $invitee = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
        $invitation = VCInvitation::model()->findByAttributes(array('videoconference_id' => $id, 'invitee_id' => $invitee->id));
        if ($invitation != null) {
            $invitation->status = "Accepted";
            $invitation->save();
            $this->redirect(array('index', 'id' => $id));
        } else {
            $message = "You are not allowed to accept this meeting invitation";
            $this->render('notAllowed', array("message" => $message));
        }


    }

    public function actionReject($id)
    {

        $invitee = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
        $invitation = VCInvitation::model()->findByAttributes(array('videoconference_id' => $id, 'invitee_id' => $invitee->id));
        if ($invitation != null) {
            $invitation->status = "Rejected";
            $invitation->save();
            $this->redirect(array('index', 'id' => $id));
        } else {
            $message = "You are not allowed to reject this meeting invitation";
            $this->render('notAllowed', array("message" => $message));
        }
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $invitationError = "";
        $moderator = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
//
//        // Uncomment the following line if AJAX validation is needed
//        $this->performAjaxValidation($model);
//
        if (isset($_POST['VideoConference'])) {
            $model->attributes = $_POST['VideoConference'];
            $model->scheduled_on = date("Y-m-d H:i:s");                 //now date

            $dateopt = $_POST['dateopt'];
            if ($dateopt == "now") {                                    //if scheduled for now, use now datetime
                $model->scheduled_for = date("Y-m-d H:i:s");
            } else if ($dateopt == "later") {                           //else get the date and validate it
                if (isset($_POST["date"]) && isset($_POST["time"])) {
                    $format = "m/d/Y H:i a";
                    $date = DateTime::createFromFormat($format, $_POST['date'] . "  " . strtolower($_POST['time']));
                    if (!$date) {
                        $model->addError('date', "Wrong format for the date and/or time ");
                        $this->render('create', array(
                            'model' => $model,
                        ));
                        exit;
                    } else {
                        $model->scheduled_for = $date->format("Y-m-d H:i:s");
                    }
                } else {
                    $model->addError('date', "Empty date or time");
                    $this->render('create', array(
                        'model' => $model,
                    ));
                    exit;
                }
            }

            if ($model->update()) {
                /* Send email update */
                $inviteeEmails = $_POST['invitees'];    //emails of all the invitees
                foreach ($inviteeEmails as $username) {
                    if ($username != null) {
                        $lname = substr($username, 0, stripos($username, ","));
                        $fname = substr($username, stripos($username, ",") + 2);
                        
                        $user = User::model()->findAllBySql("Select * from user where fname =:fnam AND lname =:lnam", array(":fnam" => $fname, ":lnam" => $lname));
                        if($user == null) {
                            $invitationError .= $username . " does not appear in our records <br>";
                        }
                        
                        foreach ($user as $invitee) {
                            $email = $invitee->email;
                            
                            if ($email == null) {             //if invitee does not exist, record the error and continue
                                $invitationError .= $username . " does not appear in our records <br>";
                                continue;
                            }                                  //moderator cannot invite him/herself
                            if ($invitee->id == $moderator->id) {
                                continue;
                            }
                            //else invitee
                            $invitation = new VCInvitation();
                            $invitation->invitee_id = $invitee->id;
                            $invitation->videoconference_id = $model->id;
                            $invitation->status = "Unknown";
    
                            //finds out if record already exists on the database
                            $invitedUser = VCInvitation::model()->exists('invitee_id = :invitee_id AND videoconference_id = :videoconference_id',
                                    array(":invitee_id"=>$invitation->invitee_id, ":videoconference_id"=>$invitation->videoconference_id));
        
                            //if user not on DB add it and send email. Else just send email.
                            if(!$invitedUser) {
                                if(!$invitation->save()) {
                                    $invitationError .= "An error occurred upon sending the invitation to " . $username .".";
                                } else {
                                    $inviteefullName = $invitee->fname . " " . $invitee->lname;
                                    VCInvitation::sendInvitationEmail($model, $inviteefullName, $email);
                                }
                            } else {
                                $inviteefullName = $invitee->fname . " " . $invitee->lname;
                                VCInvitation::sendUpdateNotification($model, $inviteefullName, $email);
                            }
                        }
                        if ($invitationError != "") {          //if there was an error
                            Yii::app()->user->setFlash('invitation-error', $invitationError);
                        }
                    }
                
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));

    }

    /**
     * Deletes a particular video conference model.
     * Only moderators are allowed
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {

            $user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
            $meeting = VideoConference::model()->findByPk($id);

            if ($user->id == $meeting->moderator_id) {
                $this->loadModel($id)->delete();
                // if AJAX request, we should not redirect the browser
                if (!isset($_GET['ajax']))
                    $this->redirect("../");
            } else {
                $message = "You are not allowed to delete this meeting";
                $this->render('notAllowed', array("message" => $message));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');

        }

    }


    /**
     * Cancels a particular video conference model.
     * Only moderators are allowed
     * @param integer $id the ID of the model to be deleted
     */
    public function actionCancel($id)
    {
        if (Yii::app()->request->isPostRequest) {

            $user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
            $meeting = VideoConference::model()->findByPk($id);

            if ($user->id == $meeting->moderator_id) {
                $this->loadModel($id)->cancel();
                // if AJAX request, we should not redirect the browser
                if (!isset($_GET['ajax']))
                    $this->redirect("../");
            } else {
                $message = "You are not allowed to cancel this meeting";
                $this->render('notAllowed', array("message" => $message));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');

        }

    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {

        $user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));

        $meetingsId = new CList();
        $invitations = VCInvitation::model()->findAllByAttributes(array("invitee_id" => $user->id));
        foreach ($invitations as $inv) {
            $meetingsId->add($inv->videoconference_id);
        }
        $meetings = VideoConference::model()->findAllByAttributes(array("moderator_id" => $user->id));
        foreach ($meetings as $meeting) {
            $meetingsId->add($meeting->id);
        }
        //$dataProvider = new CActiveDataProvider('VideoConference');
        $this->render('index', array(
            'meetingsId' => $meetingsId->toArray(),
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new VideoConference('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['VideoConference']))
            $model->attributes = $_GET['VideoConference'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return VideoConference the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = VideoConference::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param VideoConference $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'video-conference-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
