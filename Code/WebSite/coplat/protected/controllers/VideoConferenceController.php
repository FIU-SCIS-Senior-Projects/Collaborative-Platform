<?php

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
                'actions' => array('create', 'update', 'join', 'delete', 'invite'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
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
            $this->render('notAllowed', array(
                    'model' => $this->renderPartial("notAllowed")
                )
            );
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

//        Yii::trace(CVarDumper::dumpAsString($invitation));

        if ($invitation || $meeting) {
            $this->render('join', array(
                'model' => $this->loadModel($id),
            ));
        } else {
            $this->render('notAllowed', array(
                    'model' => $this->renderPartial("notAllowed")
                )
            );
        }
    }


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new VideoConference;
        $invitationError = "";

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['VideoConference'])) {
            $model->attributes = $_POST['VideoConference'];             //get the rest of the attributes
            $moderator = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
            $model->moderator_id = $moderator->id;                   //get the current users id
            $model->scheduled_on = date("Y-m-d H:i:s");                 //now

            $dateopt = $_POST['dateopt'];
            if ($dateopt == "now") {
                $model->scheduled_for = date("Y-m-d H:i:s");
            } else if ($dateopt == "later") {
                if (!$model->scheduled_for) {
                    $model->addError('scheduled_for', "Date Time Cannot Be Blank");
                    $this->render('create', array(
                        'model' => $model,
                    ));
                    exit;
                } else {                                           //validate
                    /* TODO */
                }
            }


            if ($model->save()) {
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
                    $invitation->status = "Maybe";
                    if (!$invitation->save()) {                                         //an error occurred
                        $invitationError .= "An error occurred upon saving the invitation to " . $email . "error";
                    } else {
                        $inviteefullName = $invitee->fname . " " . $invitee->lname;
                        VCInvitation::sendInvitationEmail($model->id, $model->moderator_id, $inviteefullName, $email);;
                    }
                }
                if ($invitationError != "") {
                    Yii::app()->user->setFlash('invitation-error', $invitationError);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }

        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionInvite()
    {
        //print_r("hey");
        $message = "";
        $inviteeEmails = $_GET['invitees']; // Returns an array
       // $flag = false;

        foreach ($inviteeEmails as $email) {

            $invitee = User::model()->findByAttributes(array('email' => $email));
            if ($invitee == null) {
                $message .= $email . " does not appear in our records <br>";
                continue;
            }

            //if($invitee->id == $moderator->id){
            //    continue;
            //}
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
                        $meeting = VideoConference::model()->findByAttributes(array("id" => $vc_id));
                        VCInvitation::sendInvitationEmail($meeting->id, $meeting->moderator_id, $inviteefullName, $email);;
                    }
                }
                else{
                    //print_r($invitation->invitee_id);
                    //print_r($invitation->videoconference_id);

                }
            }


        }

        if ($message == "") {
            $message = "The invitations have successfully been sent.";
        }

        print_r($message);
        /*
        if($invitationError != ""){
            Yii::app()->user->setFlash('invitation-error', $invitationError);
        }
        $this->redirect(array('view', 'id' => $model->id));
        */
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['VideoConference'])) {
            $model->attributes = $_POST['VideoConference'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect("../");
        //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
