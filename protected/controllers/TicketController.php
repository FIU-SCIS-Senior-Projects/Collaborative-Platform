<?php

class TicketController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'download','reassign', 'change', 'adminHome', 'userHome', 'escalate'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'download','reassign', 'change', 'adminHome', 'userHome', 'escalate'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'download','reassign', 'change', 'adminHome', 'userHome', 'escalate'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
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
        /*Retrieve ticket Details */
        $ticket = Ticket::model()->findByPk($id);
        /*Retrieve the names for each ticket */
        $userCreator = User::model()->findBySql("SELECT * from user  WHERE id=:id", array(":id" => $ticket->creator_user_id));
        $userAssign = User::model()->findBySql("SELECT * from user  WHERE id=:id", array(":id" => $ticket->assign_user_id));
        $domainName = Domain::model()->findBySql("SELECT * from domain  WHERE id=:id", array(":id" => $ticket->domain_id));
        $priority = Priority::model()->findBySql("SELECT * from priority WHERE id=:id", array(":id" => $ticket->priority_id));
        $tier = UserDomain::model()->findBySql("SELECT * from user_domain WHERE user_id =:id and domain_id =:id2", array(":id" => $ticket->assign_user_id, ":id2" => $ticket->domain_id));
        $subdomainName = null;
        if ($ticket->subdomain_id != null)
        {
            $subdomainName = Subdomain::model()->findBySql("SELECT * from subdomain  WHERE id=:id", array(":id" => $ticket->subdomain_id));
            $tier = UserDomain::model()->findBySql("SELECT * from user_domain WHERE user_id =:id and domain_id =:id2 and subdomain_id =:id3", array(":id" => $ticket->assign_user_id, ":id2" => $ticket->domain_id, ":id3" => $ticket->subdomain_id));

        }
        $this->render('view', array(
            'model' => $this->loadModel($id), /*Return all the ticket details */
            'userCreator' => $userCreator, 'userAssign' => $userAssign, 'domainName' => $domainName, 'subdomainName' => $subdomainName, 'priority' => $priority, 'tier' =>$tier
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Ticket;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        /*Post for Domain and Subdomain */
        if (isset($_POST['domain'])) {

            $all = array();
            $subdomains = Subdomain::model()->findAll("domain_id=:id", array(':id' => $_POST['domain'])); //   $subdomain->getAllByDomain($_POST['domain']);
            foreach ($subdomains as $subdom) {
                $all[] = array(
                    'id' => $subdom->id,
                    'name' => $subdom->name,
                );
            }
            echo json_encode($all);
            exit();
        }
        /*Post for create a new Ticket */
        if (isset($_POST['Ticket'])) {
            $model->attributes = $_POST['Ticket'];


            if ($model->domain_id == '') {
                $model->domain_id = null;
            }

            $domain_id = $model->domain_id;

            if ($model->priority_id == '') {
                $model->priority_id = null;
            }

            $priority_id = $model->priority_id;

            /* Populate ticket attributes */
            $model->creator_user_id = User::getCurrentUserId(); /*Get the ID of the user */
            $model->created_date = new CDbExpression('NOW()'); /* Get the current date and time */

            if ($model->assign_user_id != null) { /*Check first if the user has selected the assign user */
                    $model->assign_user_id = $model->assign_user_id;
                $sub = true;
                if ($model->subdomain_id == '') {
                    $sub = false;
                    $model->subdomain_id = null;
                }
            } else {
                $sub = true; /* Identify is the subdomain was specified by the user */
                if ($model->subdomain_id == '') {
                    $sub = false;
                    $model->subdomain_id = null;
                }
                if (!$sub && $domain_id != null) /*Assign the ticket to the most appropiate Domain mentor */
                    $model->assign_user_id = User::assignTicket($domain_id, $sub);
                elseif($domain_id != null)
                    $model->assign_user_id = User::assignTicket($model->subdomain_id, $sub);
            }
            $model->status = 'Pending'; /* Assign the first status of the ticket as a pending*/

            $uploadedFile = CUploadedFile::getInstance($model, 'file'); /*Attach file */
            $fileName = "{$uploadedFile}";
            if ($fileName != null) {
                /*Save file uploaded in the Uploads folder */
                $model->file = '/coplat/uploads/' . $fileName;
                $uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/' . $fileName);

            } else {
                $model->file = '';
            }
            $send = $model->isNewRecord;
            if ($model->save()) {
                /*If save if true send Notification the the Domain Mentor who was assigned the ticket */
                if($send)
                    User::sendTicketAssignedEmailNotification($model->creator_user_id,$model->assign_user_id, $model->domain_id);

                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */

       //tito
    public function actionReassign($id)//when mentors select in assign: automatically reassignment
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $old_mentor = $model->assign_user_id;

        if (isset($_POST['Ticket'])) {
            $model->attributes = $_POST['Ticket'];

            //tito
            $systemID = User::model()->findBySql("SELECT * from user  WHERE username=:id", array(":id" => 'SYSTEM'));
            if($model->assign_user_id == $systemID->id){

                $tier = 1;
                if($model->isEscalated != null){$tier = 2;}

                $boolean = true; /* Identify is the subdomain was specified by the user */
                if ($model->subdomain_id == null) {
                    $boolean = false;
                    $model->assign_user_id = User::reassignTicket($model->domain_id, $boolean, $old_mentor, $tier );
                }
                else{
                    $model->assign_user_id = User::reassignTicket($model->subdomain_id, $boolean, $old_mentor, $tier );
                }
            }

            $response = array();
            /*Change the status of the ticket to Pending from Reject */
            if($model->status = 'Reject'){
                $model->status = 'Pending';
            }

            if ($model->save()) {
                /*If save if true send Notification the the Domain Mentor who was assigned the ticket */
                User::sendStatusReassignedEmailNotificationToOldMentor($model->id, $old_mentor, User::model()->getCurrentUserId());

                if (User::isCurrentUserAdmin()) {
                    $response['url'] = "/coplat/index.php/home/adminHome";
                } else {
                    $response['url'] = "/coplat/index.php/home/userHome";
                }
            } else {
                $response['url'] = "/coplat/index.php/home/userHome";
            }
            echo json_encode($response);
            exit();
        }
    }

    public function actionTicketRejectedAdminAlert($user_id, $ticket_id)
    {
        $admins = User::model()->findAllBySql("SELECT fname, lname, email FROM user WHERE disable = 0 and activated = 1 and isAdmin = 1 and username != 'SYSTEM'");
        $user = User::model()->findByPk($user_id);
        $userfullName = $user->fname.' '.$user->lname;

        foreach($admins as $ad)
        {
            $adminfullName = $ad->fname.' '.$ad->lname;
            User::sendRejectionAlertToAdmin($ticket_id, $userfullName, $user->email, $adminfullName, $ad->email);
        }
    }

    public function actionTicketCloseddMentorAlert($user_id, $mentor_id, $ticket_id)
    {
        $mentor = User::model()->findByPk($mentor_id);
        $user = User::model()->findByPk($user_id);
        $userfullName = $user->fname.' '.$user->lname;
        $mentorfullName = $mentor->fname.' '.$mentor->lname;
        User::sendTicketClosedNotification($ticket_id, $userfullName, $user->email, $mentorfullName, $mentor->email);
    }


    /*Function to change the status of the ticket */
    public function actionChange($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        //$old_mentor = $model->assign_user_id;
        if (isset($_POST['Ticket']['status'])) {
            $newStatus = $_POST['Ticket']['status'];
            //$model->attributes = $_POST['Ticket'];
            if ($newStatus == 0) {
                $model->status = 'Close';
                if ($model->save()) {
                    if (User::isCurrentUserAdmin()) {
                        $this->actionTicketCloseddMentorAlert(User::model()->getCurrentUserId(), $model->assign_user_id, $model->id)
                        $response['url'] = "/coplat/index.php/home/adminHome";
                    } else {
                        $this->actionTicketCloseddMentorAlert(User::model()->getCurrentUserId(), $model->assign_user_id, $model->id)
                        $response['url'] = "/coplat/index.php/home/userHome";
                    }
                } else {
                    $response['url'] = "/coplat/index.php/home/userHome";
                }
                echo json_encode($response);
                exit();


            } elseif ($newStatus == 1) {
                $model->status = 'Reject';
                if ($model->save()) {
                    if (User::isCurrentUserAdmin()) {
                        $response['url'] = "/coplat/index.php/home/adminHome";
                    } else {
                        $this->actionTicketRejectedAdminAlert(User::model()->getCurrentUserId(), $model->id);
                        $response['url'] = "/coplat/index.php/home/userHome";
                    }
                } else {
                    $response['url'] = "/coplat/index.php/home/userHome";
                }



                echo json_encode($response);
                exit();
            }
        }

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        /* $dataProvider = new CActiveDataProvider('Ticket');
 $this->render('index',array(
     'dataProvider'=>$dataProvider,
     ));*/
        /** @var User $username */
        $Tickets = Ticket::model()->findAll();
        $this->render('index', array('Tickets' => $Tickets,
            //'results' => $results,
            // 'user' => $user
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Ticket('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Ticket']))
            $model->attributes = $_GET['Ticket'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Ticket the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Ticket::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Ticket $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ticket-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionEscalate($id)
    {
        $model = $this->loadModel($id);
        $modelNew = new Ticket;

        $modelNew->creator_user_id = User::getCurrentUserId();
        $modelNew->status = 'Pending';
        $modelNew->created_date = new CDbExpression('NOW()');
        $modelNew->subject = $model->subject;
        $modelNew->description = $model->description;
        $modelNew->domain_id = $model->domain_id;
        $modelNew->subdomain_id = $model->subdomain_id;
        $modelNew->file = $model->file;
        $modelNew->priority_id = $model->priority_id;
        $modelNew->isEscalated = 1;

        /*Assign the ticket to the most appropiate Domain mentor in tier2*/
        $sub = true;
        if ($model->subdomain_id == null) {
            $sub = false;
        }
        if (!$sub)  $modelNew->assign_user_id = User::escalateTicket($model->domain_id, $sub);
        else $modelNew->assign_user_id = User::escalateTicket($model->subdomain_id, $sub);

        //$send = $modelNew->isNewRecord;
        if ($modelNew->save()) {
            /*If save if true send Notification the the Domain Mentor who was assigned the ticket */
            // if($send)
            User::sendTicketAssignedEmailNotification($modelNew->creator_user_id,$modelNew->assign_user_id, $modelNew->domain_id);

            // $this->redirect(array('view', 'id' => $modelNew->id));
        }

        $sql = 'INSERT INTO comment(description, added_date, ticket_id, user_added) SELECT description, added_date,' . $modelNew->id . ', user_added FROM comment WHERE ticket_id =' . $model->id;
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();

        $sql2 = 'INSERT INTO comment(description, added_date, ticket_id, user_added) VALUES ("Ticket ' . $model->id . ' was escalated to ticket '. $modelNew->id . '" , ' . $modelNew->created_date. ',' . $model->id . ', "System")';
        $command2 = Yii::app()->db->createCommand($sql2);
        $command2->execute();

        $sql3 = 'INSERT INTO comment(description, added_date, ticket_id, user_added) VALUES ("Ticket ' . $model->id . ' was escalated to ticket '. $modelNew->id . '" , ' . $modelNew->created_date. ',' . $modelNew->id . ', "System")';
        $command3 = Yii::app()->db->createCommand($sql3);
        $command3->execute();


        $response = array();
        $response['url'] = "/coplat/index.php/home/userHome";
        echo json_encode($response);
        exit();
    }



    public function actionDownload()
    {
        // place this code inside a php file and call it f.e. "download.php"
        $path = $_SERVER['DOCUMENT_ROOT'] . "/"; // change the path to fit your websites document structure
        $fullPath = $path . $_GET['download_file'];
        if ($fd = fopen($fullPath, "r")) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "pdf":
                    header("Content-type: application/pdf"); // add here more headers for diff. extensions
                    header("Content-Disposition: attachment; filename=\"" . $path_parts["basename"] . "\""); // use 'attachment' to force a download
                    break;
                default;
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: filename=\"" . $path_parts["basename"] . "\"");
            }
            header("Content-length: $fsize");
            header("Cache-control: private"); //use this to open files directly
            while (!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        }
        fclose($fd);
        exit;
    }
}
