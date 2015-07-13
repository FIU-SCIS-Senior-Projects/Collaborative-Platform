<?php

class AwayMentorController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

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
                'actions'=>array(),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('remove'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete','remove','index','view','create','update', 'add'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */

    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new AwayMentor;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['name_search']))
        {
            $userName = $_POST['name_search'];
            $lname = substr($userName, 0, stripos($userName, ","));
            $fname = substr($userName, stripos($userName, ",")+2);
            $mentorError = "";
            $output = "<script>console.log( 'Debug Objects: " . $lname." ".$fname . "' );</script>";
            
            echo $output;
            $user = User::model()->findAllBySql("Select * from user where fname =:fnam AND lname =:lnam", array(":fnam"=>$fname, ":lnam"=>$lname));
            if($user == null) {
                 $mentorError .= $lname. " ". $fname. " is not a mentor. <br>";
                 Yii::app()->user->setFlash('invitation-error', $mentorError);
            }
            
            foreach($user as $amentor)
            {
                if($amentor->isPerMentor == 1 || $amentor->isProMentor == 1 || $amentor->isDomMentor == 1 ) { //MANDY if this isnt true tell the user it wasnt a mentor
                    $away_already = AwayMentor::model()->findByPk($amentor->id);
                    if (is_null($away_already)) {
                        $output = "<script>console.log( 'Debug Objects: " . $amentor->id . "' );</script>";
                        echo $output;
                        $model->userID = $amentor->id;
                        if ($model->save())
                            $this->redirect(array('admin'));
                    } else {
                        $notAMentor = $amentor->getLastCommaFirst() . " is already on the Away Mentor list. <br>";
                        Yii::app()->user->setFlash('invitation-error', $notAMentor);
                        break; //MANDY if this occurs Tell the tell the user they are already on the list.
                    }
                }
                // *** ADDED ***
                else {  //not a mentor
                    $notAMentor = $amentor->getLastCommaFirst() . " is not a mentor. <br>";
                    Yii::app()->user->setFlash('invitation-error', $notAMentor);
                    continue;
                }
                //*** ADDED ***
            }
        }
        else{
            $output = "<script>console.log( 'Dsfebug Objects: ". implode($_POST) ."' );</script>";

            echo $output;
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }
    public function actionFindUserName() {
        $q = $_GET['term'];
        if (isset($q)) {
            $criteria = new CDbCriteria;
            //condition to find your data, using q as the parameter field
            if (strstr($q, ","))
            {
                $q1 = substr($q, stripos($q, ",")+1);
                $q = substr($q, 0, stripos($q, ","));
            }
            else{
                $q1 = $q;
            }
            $criteria->condition = "lname LIKE :q OR fname LIKE :q1";
            $criteria->order = 'lname'; // correct order-by field
            $criteria->limit = 10; // probably a good idea to limit the results
            // with trailing wildcard only; probably a good idea for large volumes of data
            $criteria->params = array(':q' => trim($q) . '%', ':q1'=>trim($q1).'%');
            $Users = User::model()->findAll($criteria);

            if (!empty($Users)) {
                $out = array();
                foreach ($Users as $p) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $p->LastCommaFirst,
                        'value' => $p->LastCommaFirst,
                        'id' => $p->id, // return value from autocomplete
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }
    public function actionMikeFindUserName() {
        $q = $_GET['term'];
        if (isset($q)) {
            $criteria = new CDbCriteria;
            //condition to find your data, using q as the parameter field
            if (strstr($q, ","))
            {
                $q1 = substr($q, stripos($q, ",")+1);
                $q = substr($q, 0, stripos($q, ","));
            }
            else{
                $q1 = $q;
            }
            $criteria->condition = "(lname LIKE :q OR fname LIKE :q1) and (isPerMentor = 1 or isProMentor = 1 or isDomMentor = 1)";
            $criteria->order = 'lname'; // correct order-by field
            $criteria->limit = 10; // probably a good idea to limit the results
            // with trailing wildcard only; probably a good idea for large volumes of data
            $criteria->params = array(':q' => trim($q) . '%', ':q1'=>trim($q1).'%');
            $Users = User::model()->findAll($criteria);

            if (!empty($Users)) {
                $out = array();
                foreach ($Users as $p) {
                    $out[] = array(
                        // expression to give the string for the autoComplete drop-down
                        'label' => $p->LastCommaFirst,
                        'value' => $p->LastCommaFirst,
                        'id' => $p->id, // return value from autocomplete
                    );
                }
                echo CJSON::encode($out);
                Yii::app()->end();
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['AwayMentor']))
        {
            $model->attributes=$_POST['AwayMentor'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->userID));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }
    public function actionRemove($id)
    {
        AwayMentor::model()->deleteByPk($id);
        Yii::app()->request->redirect(Yii::app()->homeURL);
    }
    public function actionAdd($id)
    {
        $model = new AwayMentor();
        $model->userID = $id;
        $model->tiStamp= new CDbExpression('NOW()');
        $model->save();
        $this->redirect('/coplat/index.php/AwayMentor/admin');
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
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('AwayMentor');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new AwayMentor('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['AwayMentor']))
            $model->attributes=$_GET['AwayMentor'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return AwayMentor the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=AwayMentor::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param AwayMentor $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='away-mentor-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
