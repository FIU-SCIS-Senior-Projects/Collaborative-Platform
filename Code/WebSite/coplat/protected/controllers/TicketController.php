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
                'actions' => array('index', 'view', 'download','reassign', 'change', 'adminHome', 'userHome', 'escalate', 'AutomaticReassignBySystem'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'download','reassign', 'reject', 'change', 'adminHome', 'userHome', 'escalate', 'AutomaticReassignBySystem'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'download','reassign','reject', 'change', 'adminHome', 'userHome', 'escalate', 'AutomaticReassignBySystem', 'viewModal'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionViewmodal($id)
    {
    	$this->layout = '';
    	$model = $this->loadModel($id);

    	if( Yii::app()->request->isAjaxRequest )
    		$this->renderPartial('viewmodal',array('model'=>$model,), false, true);
    	else
    		$this->render('viewmodal',array('model'=>$model,));
    	 
    }
    
    public function actionUpdateStatus(){
    	$es = new EditableSaver('Ticket');  //'User' is name of model to be updated
    	$es->update();
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
        
        
       if (!Yii::app()->request->isPostRequest && !Yii::app()->request->isAjaxRequest)  
       {
           $curentUserID = User::getCurrentUserId();
              
           if ($ticket->creator_user_id == $curentUserID)
           {
              TicketEvents::recordEvent(EventType::Event_Opened_By_Owner, 
                                        $ticket->id, 
                                        NULL, 
                                        NULL, 
                                        NULL);             
           }else
           {
                TicketEvents::recordEvent(EventType::Event_Opened_By_Mentor, 
                                          $ticket->id, 
                                          NULL, 
                                          NULL, 
                                          NULL); 
           }   
       }
        
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
            
            if (!isset($model->assigned_project_id) || $model->assigned_project_id == '')
            {
                $model->assigned_project_id = null;
            }

            //$priority_id = $model->priority_id;

            /* Populate ticket attributes */
            $model->creator_user_id = User::getCurrentUserId(); /*Get the ID of the user */
            $model->created_date = new CDbExpression('NOW()'); /* Get the current date and time */
            $model->assigned_date = new CDbExpression('NOW()'); /* Get the current date and time */

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
            
            
           
            
            //do a validation before introducing the overgead of the transaction 
            if ($model->validate())
            {
                 $isNewTicket = $model->isNewRecord;
                 $saved = true;
                 $trans = Yii::app()->db->beginTransaction();
                
                try {                    
                    //save the ticket
                    $model->save();               
                              
                   //save the NEW event
                   if ($isNewTicket)
                   {
                   
                   TicketEvents::recordEvent(EventType::Event_New, 
                                             $model->id, 
                                             NULL, 
                                             NULL, 
                                             NULL);
                    }  
                    $trans->commit();
                } catch (Exception $e) 
                {
                $trans->rollback();
                 Yii::log("Error occurred while saving the ticket or its events. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
                $saved = false;
                }
                
                 if ($saved) {
                    /*If save if true send Notification the the Domain Mentor who was assigned the ticket */
                    if($isNewTicket)
                      User::sendTicketAssignedEmailNotification($model->creator_user_id,$model->assign_user_id, $model->domain_id, $model->id);

                   $this->redirect(array('view', 'id' => $model->id));
                 } 
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
    public function actionReject($id)
    {


        /*Retrieve ticket Details */
        $model = Ticket::model()->findByPk($id);

        $old_mentor = $model->assign_user_id;
        $current_user = User::model()->getCurrentUserId();
        if ($old_mentor == $current_user) {
            $this->render("reject");
            //begin collecting all the data
            $tier = 1;
            if ($model->isEscalated != null) {
                $tier = 2;
            }
            $rule = ReassignRules::model()->findBySql("Select * from reassign_rules where rule_id =1");

            $count = TicketEvents::model()->findBySql("Select COUNT(id) as 'id' from ticket_events where event_type_id = 3 and ticket_id =:tid", array(":tid" => $id));
            if ($count->id >= $rule->setting) 
            {
                //reassign to system admin to many reassigns.
                $model->assign_user_id =  5;
            }
            else {
                $boolean = true; /* Identify is the subdomain was specified by the user */
                if ($model->subdomain_id == null) {
                    $boolean = false;
                    $model->assign_user_id = User::reassignTicket($model->domain_id, $boolean, $old_mentor, $tier, $id);
                } else {
                    $model->assign_user_id = User::reassignTicket($model->subdomain_id, $boolean, $old_mentor, $tier, $id);
                }
            }


            $recordStatusChangeFromRejectToPending = false;
            /*Change the status of the ticket to Pending from Reject */
            if ($model->status == Ticket::Status_Reject) {
                $model->status = Ticket::Status_Pending;
                $recordStatusChangeFromRejectToPending = true;
            }
            $model->assigned_date = new CDbExpression('NOW()'); /* Get the current date and time */


            //Save all the ticket with it's transactions
            $saved = true;
            $trans = Yii::app()->db->beginTransaction();
            try {
                //save the ticket
                $model->save();

                //save the Reassign event
                TicketEvents::recordEvent(EventType::Event_AssignedOrReasignedToUser,
                    $model->id,
                    $old_mentor,
                    $model->assign_user_id,
                    NULL);


                if ($recordStatusChangeFromRejectToPending) {
                    TicketEvents::recordEvent(EventType::Event_Status_Changed,
                        $model->id,
                        Ticket::Status_Reject,
                        Ticket::Status_Pending,
                        NULL);
                }


                $trans->commit();
            } catch (Exception $e) {
                $trans->rollback();
                Yii::log("Error occurred while saving the ticket or its events. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
                $saved = false;
            }


            //prepare the response
            $response = array();
            if ($saved) {
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
            User::sendTicketAssignedEmailNotification($model->creator_user_id,$model->assign_user_id, $model->domain_id, $model->id);
            //
            //Yii::app()->request->redirect(Yii::app()->homeURL);
        }
        else{
            Yii::app()->request->redirect(Yii::app()->homeURL);
        }

    }
    public function actionReassign($id)//when mentors select in assign: automatically reassignment
    {
        //first load the ticket from the DB in order to extract the old mentor and to make an update
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $old_mentor = $model->assign_user_id;

        if (isset($_POST['Ticket'])) {
            
            
            //begin collecting all the data
            $model->attributes = $_POST['Ticket'];

            $systemID = User::model()->findBySql("SELECT * from user  WHERE username=:id", array(":id" => 'SYSTEM'));
            if($model->assign_user_id == $systemID->id){

                $tier = 1;
                if($model->isEscalated != null){$tier = 2;}

                $boolean = true; /* Identify is the subdomain was specified by the user */
                if ($model->subdomain_id == null) {
                    $boolean = false;
                    $model->assign_user_id = User::reassignTicket($model->domain_id, $boolean, $old_mentor, $tier, $id );
                }
                else{
                    $model->assign_user_id = User::reassignTicket($model->subdomain_id, $boolean, $old_mentor, $tier, $id );
                }
            }

            $recordStatusChangeFromRejectToPending = false;
            /*Change the status of the ticket to Pending from Reject */
            if($model->status == Ticket::Status_Reject){
                $model->status = Ticket::Status_Pending;
                $recordStatusChangeFromRejectToPending = true;
            }
            $model->assigned_date = new CDbExpression('NOW()'); /* Get the current date and time */
            
            
             //Save all the ticket with it's transactions
             $saved = true;
             $trans = Yii::app()->db->beginTransaction();
             try 
             {
                 //save the ticket
                 $model->save();
                 
                 //save the Reassign event
                 TicketEvents::recordEvent(EventType::Event_AssignedOrReasignedToUser, 
                                           $model->id,
                                           $old_mentor, 
                                           $model->assign_user_id, 
                                           NULL);
                 
                 
                 if ($recordStatusChangeFromRejectToPending)
                 {
                     TicketEvents::recordEvent(EventType::Event_Status_Changed, 
                                               $model->id,
                                               Ticket::Status_Reject, 
                                               Ticket::Status_Pending, 
                                               NULL);                    
                 }
                                 
                 
                 $trans->commit();
             } 
             catch (Exception $e) 
             {
              $trans->rollback();
              Yii::log("Error occurred while saving the ticket or its events. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
              $saved = false;
            }
            
            
            //prepare the response
            $response = array();             
            if ($saved) {
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

    public function actionAutomaticReassignBySystem()
    {
        $TicketsO = Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE id in (SELECT T.id FROM ticket T
                        LEFT JOIN
                        (SELECT MAX(C3.id) AS CommID, C3.ticket_id FROM comment C3 WHERE (C3.user_added = (CONCAT((SELECT u1.fname FROM user u1 WHERE u1.id = (select T1.assign_user_id FROM ticket T1 where T1.id = C3.ticket_id)), ' ',(SELECT u2.lname FROM user u2 where u2.id = (select T2.assign_user_id FROM ticket T2 where T2.id = C3.ticket_id)) )) )
                        GROUP BY ticket_id)
                        C2 ON  (C2.ticket_id=T.id)
                        LEFT JOIN
                        (SELECT MIN(C4.id) AS CommID2, C4.ticket_id FROM comment C4 WHERE
                        (C4.id > (SELECT MAX(C3.id) AS CommID FROM comment C3 WHERE (C3.ticket_id = C4.ticket_id) and (C3.user_added = (CONCAT((SELECT u1.fname FROM user u1 WHERE u1.id = (select T1.assign_user_id FROM ticket T1 where T1.id = C3.ticket_id)), ' ',(SELECT u2.lname FROM user u2 where u2.id = (select T2.assign_user_id FROM ticket T2 where T2.id = C3.ticket_id)) )) )
                        GROUP BY ticket_id))
                         AND
                        (C4.user_added = (CONCAT((SELECT u1.fname FROM user u1 WHERE u1.id = (select T3.creator_user_id FROM ticket T3 where T3.id = C4.ticket_id)), ' ',(SELECT u3.lname FROM user u3 where u3.id = (select T4.creator_user_id FROM ticket T4 where T4.id = C4.ticket_id)) )) )
                        GROUP BY ticket_id)
                        C5 ON  (C5.ticket_id=T.id)
                        LEFT JOIN comment CMentor ON (CMentor.id=CommID)
                        LEFT JOIN comment CMentee ON (CMentee.id=CommID2)
                        LEFT JOIN priority P ON T.priority_id = P.id
                        WHERE
                        T.status = 'Pending'
                        AND (
                            (CMentee.added_date IS NOT NULL AND (NOW() > CMentee.added_date + INTERVAL P.reassignHours hour) AND  (NOW() > T.assigned_date + INTERVAL P.reassignHours hour))
                        OR (CMentee.added_date IS NULL AND CMentor.added_date IS NULL AND  (NOW() > T.assigned_date + INTERVAL P.reassignHours hour))
                            ))
                    ");


        foreach ($TicketsO as $model)
        {
            $old_mentor = $model->assign_user_id;
            $theOldMentor = User::model()->findBySql("SELECT * from user  WHERE id=:id", array(":id" => $old_mentor));
            $theOldMentorName  = $theOldMentor->fname . " " . $theOldMentor->lname;

            $mentor1 = 0;
            if ($model->Mentor1 != null){$mentor1 = $model->Mentor1;}

            $mentor2 = 0;
            if ($model->Mentor2 != null){$mentor2 = $model->Mentor2;}

            $tier = 1;
            if($model->isEscalated != null){$tier = 2;}

            $newMentorId = 0;

            $boolean = true; /* Identify is the subdomain was specified */
            if ($model->subdomain_id == null) {
                $boolean = false;
                $newMentorId = User::automaticReassignBySystem($model->domain_id, $boolean, $old_mentor, $tier, $mentor1 , $mentor2 );
            }
            else{
                $newMentorId = User::automaticReassignBySystem($model->subdomain_id, $boolean, $old_mentor, $tier, $mentor1, $mentor2 );
            }

            if($newMentorId == 0)/* no available mentor different to current mentor, Mentor1 and Mentor2*/
            {
                $boolean = true; /* Identify is the subdomain was specified */
                if ($model->subdomain_id == null) {
                    $boolean = false;
                    $newMentorId = User::automaticReassignBySystem($model->domain_id, $boolean, $old_mentor, $tier, 0 , 0);
                }
                else{
                    $newMentorId = User::automaticReassignBySystem($model->subdomain_id, $boolean, $old_mentor, $tier, 0, 0 );
                }

                if($newMentorId == 0)/* no available mentor different that current mentor*/
                {
                    //$sql = 'INSERT INTO comment(description, added_date, ticket_id, user_added) VALUES ("This ticket was not reassigned","'  . $model->assigned_date . '",' . $model->id . ', "System")';
                    //$command = Yii::app()->db->createCommand($sql);
                    //$command->execute();

                    $admins = User::model()->findAllBySql("SELECT fname, lname, email FROM user WHERE disable = 0 and activated = 1 and isAdmin = 1 and username != 'SYSTEM'");

                    foreach($admins as $ad)
                    {
                        $adminfullName = $ad->fname.' '.$ad->lname;
                        User::sendNotification( $ad->email,"Ticket #" . $model->id . " require your attention", "The ticket has not been answered and there is not another available mentor." , $adminfullName);

                    }

                    //send notification to admin tito1
                    $model->assigned_date = new CDbExpression('NOW()'); /* Get the current date and time */
                    $model->Mentor1 = null;
                    $model->Mentor2 = null;
                    if ($model->save()) {}
                }
            }


            if($newMentorId != 0)
            {
                if ($model->Mentor2 != null)
                {
                    $admins = User::model()->findAllBySql("SELECT * FROM user WHERE disable = 0 and activated = 1 and isAdmin = 1 and username != 'SYSTEM' and email is not null");

                    foreach($admins as $ad)
                    {
                        $adminfullName = $ad->fname.' '.$ad->lname;
                        User::sendNotification( $ad->email,"Ticket #" . $model->id . " require your attention", "The ticket has not been answered. It requires your attention." , $adminfullName);
                    }

                    //send notification to admin tito2
                    $model->Mentor1 = null;
                    $model->Mentor2 = null;
                }
                else
                {
                    if ($model->Mentor1 == null)
                    {
                        $model->Mentor1 = $model->assign_user_id;
                    }
                    else
                    {
                        $model->Mentor2 = $model->assign_user_id;
                    }
                }

                $model->assign_user_id = $newMentorId;
                $model->assigned_date = new CDbExpression('NOW()'); /* Get the current date and time */


                //create comment to ticket

                if ($model->save()) {

                    $theNew = $model->assign_user_id;
                    $theNewMentor = User::model()->findBySql("SELECT * from user  WHERE id=:id", array(":id" => $theNew));
                    $theNewMentorName  = $theNewMentor->fname . " " .$theNewMentor->lname;

                    $time =  new CDbExpression('NOW()');

                    $sql = 'INSERT INTO comment(description, added_date, ticket_id, user_added) VALUES (" This ticket was automatically reassigned by the system from mentor '.$theOldMentorName. ' to mentor ' . $theNewMentorName .'",'  . $time . ',' . $model->id . ', "System")';
                    $command = Yii::app()->db->createCommand($sql);
                    $command->execute();

                    /*If save if true send Notification the the Domain Mentor who was assigned the ticket */
                    $systemID = User::model()->findBySql("SELECT * from user  WHERE username=:id", array(":id" => 'SYSTEM'));
                    User::sendStatusAutoReassignedEmailNotificationToOldMentor($model->id, $old_mentor, $systemID);

                    $Mentee = $model->creator_user_id;
                    $theMentee = User::model()->findBySql("SELECT * from user  WHERE id=:id", array(":id" => $Mentee));
                    $theMenteeName  = $theMentee->fname . " " .$theMentee->lname;

                    //mentee
                    User::sendNotification( $theMentee->email,"Ticket #" . $model->id . " was reassigned", "Ticket #" . $model->id . " was reassigned" , $theMenteeName);
                    //new mentor
                    User::sendNotification( $theNewMentor->email,"Ticket #" . $model->id . " has been assigned to you.", "Ticket #" . $model->id . " has been assigned to you." , $theNewMentorName);

                }
            }
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

    /*Function to change the status of the ticket */
    public function actionChange($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        //$old_mentor = $model->assign_user_id;
              
        
         if (isset($_POST['Ticket']['status'])) 
         {
            $newStatus = $_POST['Ticket']['status'];
            
            $oldStatus = $model->status;
                      
            
            //prepare the model according to the status
             if ($newStatus == 0) {
                  $model->status = Ticket::Status_Close;
                  $model->closed_date = new CDbExpression('NOW()');
             } elseif ($newStatus == 1) {
                  $model->status = Ticket::Status_Reject;
             }            
             
             //save the canges
             $saved = true;
             $trans = Yii::app()->db->beginTransaction();
                
                try {                    
                    //save the ticket
                    $model->save();               
                              
                    //save the NEW event
                    TicketEvents::recordEvent(EventType::Event_Status_Changed, 
                                              $model->id,
                                              $oldStatus, 
                                              $model->status, 
                                              NULL);
                   
                    $trans->commit();
                } catch (Exception $e) 
                {
                  $trans->rollback();
                  Yii::log("Error occurred while saving the ticket or its events. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
                  $saved = false;
                }
             
             //preparae the routing etc
             if ($saved)
             {
                   if (User::isCurrentUserAdmin()) {
                        $response['url'] = "/coplat/index.php/home/adminHome";
                    } else {
                        $response['url'] = "/coplat/index.php/home/userHome";
                    }
                    
                   if ($model->status == Ticket::Status_Close)
                   {
                    //mentor notification
                    $mentor_id = $model->assign_user_id;
                    $mentor = User::model()->findByPk($mentor_id);
                    $mentorfullName = $mentor->fname.' '.$mentor->lname;
                    User::sendNotification( $mentor->email,"Ticket #" . $model->id . " has been closed.", "Ticket #" . $model->id . " has been closed." , $mentorfullName);
                   }elseif ($model->status == Ticket::Status_Reject && !User::isCurrentUserAdmin())
                   {
                       $this->actionTicketRejectedAdminAlert(User::model()->getCurrentUserId(), $model->id);
                   }
             }
             else
             {
                $response['url'] = "/coplat/index.php/home/userHome";
             }
             
             echo json_encode($response);
             exit();
         }              
         
           /* if ($newStatus == 0) {
                $model->status = 'Close';
                $model->closed_date = new CDbExpression('NOW()');
                if ($model->save()) {
                    if (User::isCurrentUserAdmin()) {
                        $response['url'] = "/coplat/index.php/home/adminHome";
                    } else {
                        $response['url'] = "/coplat/index.php/home/userHome";
                    }

                    //mentor notification
                    $mentor_id = $model->assign_user_id;
                    $mentor = User::model()->findByPk($mentor_id);
                    $mentorfullName = $mentor->fname.' '.$mentor->lname;
                    User::sendNotification( $mentor->email,"Ticket #" . $model->id . " has been closed.", "Ticket #" . $model->id . " has been closed." , $mentorfullName);


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
        }*/

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
    	$this->layout='';
        $model = new Ticket('search');
        
        $cUser = User::model()->findAllBySql("select id, fname, lname from user where activated = 1 and disable = 0 order by lname");
        $data1 = array();
        
        foreach($cUser as $u){
        	$data1[$u->id] = $u->fname.' '.$u->lname;
        }

        $aUser = User::model()->findAllBySql("select id, fname, lname from user where activated = 1 and disable = 0 order by lname");
        $data2 = array();
        
        foreach($aUser as $u){
        	$data2[$u->id] = $u->fname.' '.$u->lname;
        }
        
        $dom = Domain::model()->findAllBySql("select id, name from domain order by name");
        $data3 = array();
        
        foreach($dom as $u){
        	$data3[$u->id] = $u->name;
        }
        
        $subdom = Subdomain::model()->findAllBySql("select id, name from subdomain order by name");
        $data4 = array();
        
        foreach($subdom as $u){
        	$data4[$u->id] = $u->name;
        }
        
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Ticket']))
            $model->attributes = $_GET['Ticket'];

        $this->render('admin', array(
            'model' => $model, 'data1' => $data1, 'data2'=>$data2,'data3'=>$data3,'data4'=>$data4,
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
        $modelNew->assigned_date = new CDbExpression('NOW()'); /* Get the current date and time */


        /*Assign the ticket to the most appropiate Domain mentor in tier2*/
        $sub = true;
        if ($model->subdomain_id == null) {
            $sub = false;
        }
        if (!$sub)  $modelNew->assign_user_id = User::escalateTicket($model->domain_id, $sub);
        else $modelNew->assign_user_id = User::escalateTicket($model->subdomain_id, $sub);
        
         $saved = true;
         $trans = Yii::app()->db->beginTransaction();
         
         try 
         {
             $saved = $modelNew->save();
             
             $sql = 'INSERT INTO comment(description, added_date, ticket_id, user_added) SELECT description, added_date,' . $modelNew->id . ', user_added FROM comment WHERE ticket_id =' . $model->id;
             $command = Yii::app()->db->createCommand($sql);
             $command->execute();
             
             //generate the escalated events
             TicketEvents::recordEvent(EventType::Event_Escalated_To, 
                                       $model->id,
                                       NULL, 
                                       $modelNew->id, //refrence to the new ticket
                                       NULL);
             
             //generate the new event
             TicketEvents::recordEvent(EventType::Event_New, 
                                       $modelNew->id, 
                                       NULL, 
                                       NULL, 
                                       NULL);
             
             //generate the escalated events
             TicketEvents::recordEvent(EventType::Event_Escalated_From,
                                       $modelNew->id, 
                                       $model->id, 
                                       NULL, 
                                       NULL);
                                 
              
             
             $trans->commit();
         }catch (Exception $e) 
        {
                $trans->rollback();
                Yii::log("Error occurred while saving the ticket or its events. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
                $saved = false;
        }
        

        //$send = $modelNew->isNewRecord;
        if ($saved) 
        {
            /*If save if true send Notification the the Domain Mentor who was assigned the ticket */
            // if($send)
            User::sendTicketAssignedEmailNotification($modelNew->creator_user_id,
                                                      $modelNew->assign_user_id,
                                                      $modelNew->domain_id,
                                                      $modelNew->id);

            // $this->redirect(array('view', 'id' => $modelNew->id));

            //copy all the comments from the old ticket to the new ticket
           

            //this has been substituted here for a change of status
          /*  $sql2 = 'INSERT INTO comment(description, added_date, ticket_id, user_added) VALUES ("Ticket ' . $model->id . ' was escalated to ticket '. $modelNew->id . '" , ' . $modelNew->created_date. ',' . $model->id . ', "System")';
            $command2 = Yii::app()->db->createCommand($sql2);
            $command2->execute();

            $sql3 = 'INSERT INTO comment(description, added_date, ticket_id, user_added) VALUES ("Ticket ' . $model->id . ' was escalated to ticket '. $modelNew->id . '" , ' . $modelNew->created_date. ',' . $modelNew->id . ', "System")';
            $command3 = Yii::app()->db->createCommand($sql3);
            $command3->execute();*/


            $response = array();
            $response['url'] = "/coplat/index.php/home/userHome";


            echo json_encode($response);
            exit();
        }
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
