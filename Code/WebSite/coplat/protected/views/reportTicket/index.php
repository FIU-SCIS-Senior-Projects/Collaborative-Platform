<?php
$this->breadcrumbs=array('Ticket Report');
?>
<h1>Ticket Report</h1>
<style type="text/css">

   table {
        table-layout: fixed;
        width:2000px;
    }
    .container  {
          display:table;   
    }

    .grid-view  {
         display:table;
      }

    .summary {
        text-align:left !important;
    }
</style>
<?php 
      function getZeroOneToYesNo($value)
      {
           $res = "Yes";
           
           if ($value == 0)
               $res = "No";
           
           return $res;
      
      }

      function getTicketColumns($model)
      {
          
         $columns = array();
         
         
         //ticket ID
         $ticketID =  array('name'  => 'ticketID',
                            'header'=> 'Ticket #',
                            'filter'=> CHtml::activeTextField($model, 'ticketID'),
                            'headerHtmlOptions' => array('width'=>'75', ));
         $columns[] = $ticketID;
         
         //creator Name
         $creatorName =  array('name'  => 'creatorName',
                               'header'=> 'Creator Name',
                              'headerHtmlOptions' => array('width'=>'200', ));
         $columns[] = $creatorName;
         
         //creator ID
         $creatorID =  array('name'  => 'creatorID',
                             'header'=> 'Creator ID',
                             'headerHtmlOptions' => array('width'=>'75', ));
         $columns[] = $creatorID;
         
         //creator Disabled
         $creatorDisabled = array('name'  => 'creatorDisabled',
                                  'header'=> 'Creator Disabled',
                                  'value' => 'getZeroOneToYesNo($data->creatorDisabled)',
                                  'headerHtmlOptions' => array('width'=>'80', ));
         $columns[] = $creatorDisabled;
         
         //creator Email
         $creatorEmail = array('name'  => 'creatorEmail',
                               'header'=> 'Creator Email',
                               'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $creatorEmail;
         
         
         
         //ticket status
         $ticketStatus = array('name'  => 'ticketStatus',
                               'header'=> 'Ticket Status',
                               'headerHtmlOptions' => array('width'=>'80', ));
         $columns[] = $ticketStatus;
         
         
         
         
         //ticket created date
         $ticketCreatedDate = array('name'  => 'ticketCreatedDate',
                                    'header'=> 'Created Date',
                                    'headerHtmlOptions' => array('width'=>'90', ));
         $columns[] = $ticketCreatedDate; 
         
         
         //ticket assigned to user name
         $assignedToName =    array('name'  => 'assignedUserName',
                                    'header'=> 'Assigned To (Name)',
                                    'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $assignedToName; 
      
         //ticket assigned to user ID
         $assignedToID =    array('name'  => 'ticketAssignUserID',
                                  'header'=> 'Assigned To (Id)',
                                  'headerHtmlOptions' => array('width'=>'80', ));
         $columns[] = $assignedToID; 
         
         
         //ticket assigned to user disabled
         $assignedToDisabled =    array('name'  => 'assignedUserDisabled',
                                  'header'=> 'Assigned To (Disabled)',
                                  'value' => 'getZeroOneToYesNo($data->assignedUserDisabled)',
                                  'headerHtmlOptions' => array('width'=>'100', ));
         $columns[] = $assignedToDisabled; 
         
         
         //ticket assigned to user disabled
         $assignedToEmail =    array('name'  => 'assignedUserEmail',
                                    'header'=> 'Assigned To (Email)',
                                    'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $assignedToEmail; 
         
         //ticket dommain
         $ticketDomain =    array('name'  => 'ticketDomainName',
                                  'header'=> 'Ticket Domain',
                                  'headerHtmlOptions' => array('width'=>'170', ));
         $columns[] = $ticketDomain; 
         
         
         //ticket subdomain
         $ticketSubDomain =    array('name'  => 'ticketSubDomainName',
                                    'header'=> 'Ticket Sub Domain',
                                    'headerHtmlOptions' => array('width'=>'170', ));
         $columns[] = $ticketSubDomain; 
         
         
         //ticket priority
         $ticketPriority =    array('name'  => 'ticketPriorityDescription',
                                    'header'=> 'Ticket Priority',
                                    'headerHtmlOptions' => array('width'=>'80', ));
         $columns[] = $ticketPriority; 
         
         
        //ticket ticketAssignedDate
         $ticketAssignedDate =  array('name'  => 'ticketAssignedDate',
                                    'header'=> 'Ticket Assigned Date',
                                    'headerHtmlOptions' => array('width'=>'120', ));
         $columns[] = $ticketAssignedDate; 
         
         
        //ticket closed date
         $ticketClosedDate = array('name'  => 'ticketClosedDate',
                                    'header'=> 'Ticket Closed Date',
                                    'headerHtmlOptions' => array('width'=>'120', ));
         $columns[] = $ticketClosedDate; 
         
       //ticket excalated
         $ticketIsEscalated = array('name'  => 'ticketIsEscalated',
                                    'header'=> 'Excalated',
                                    'value' => 'getZeroOneToYesNo($data->ticketIsEscalated)',
                                    'headerHtmlOptions' => array('width'=>'80', ));
         $columns[] = $ticketIsEscalated; 
                  
         
        //ticket subject
         $ticketSubject =  array('name'  => 'ticketSubject',
                                 'header'=> 'Subject',
                                  'headerHtmlOptions' => array('width'=>'300', ));
         $columns[] = $ticketSubject; 
         
        //ticket description
         $ticketDescription = array('name'  => 'ticketDescription',
                                    'header'=> 'Description',
                                    'headerHtmlOptions' => array('width'=>'400', ));
         $columns[] = $ticketDescription; 
         
         return $columns;
      }
      
      

      
      $this->widget('bootstrap.widgets.TbGridView', 
                    array('id'=>'ticket-grid',                          
                          'type'=>'striped condensed',
                          'dataProvider'=> $model->search(),
                          'filter'=>$model,
                          'columns' =>getTicketColumns($model) ));
                          
?>