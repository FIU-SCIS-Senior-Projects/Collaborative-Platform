<?php

/**
 * ReportTicketController short summary.
 *
 * ReportTicketController description.
 *
 * @version 1.0
 * @author aalfonso
 */
class ReportTicketController extends Controller 
{
    
    private $reportResultDataProvider;
       
      
    //////////////////////////////////////////Controll
    public function filters()
    {
        return array('accessControl'); // perform access control for CRUD operations
    }
    
    //this is for the access rules
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'users'=>array('admin')),
            array('deny',  // deny all users
                'users'=>array('*')),
        );
    }
    
    //////////////////////////////From here begins all actions/////////////////////////////////
    
    //this is the default action
    public function actionIndex()
    {
        $this->layout = '//layouts/column1'; // very simple layout (no layout)
        echo("<script>console.log('actionIndex');</script>");
        
       
       
       // $results = Yii::app()->db->createCommand()->select()->from('report_ticket')->queryAll();
       
        
       // $reportResultDataProvider = new CArrayDataProvider($results);
        //$reportResultDataProvider->keyField = 'ticketID' ;       

         //$dataProvider=new CActiveDataProvider('User');
        //$this->render('index', array ('reportResultDataProvider' => $reportResultDataProvider));  ///,array('dataProvider'=>$dataProvider)
       
        $model = new ReportTicket('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['ReportTicket'])) {
            $model->attributes=$_GET['ReportTicket'];
        }
        $this->render('index', array('model' => $model, ));
        
    }   

    
}
