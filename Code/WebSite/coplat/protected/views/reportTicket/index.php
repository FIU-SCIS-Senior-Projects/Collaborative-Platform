<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
$this->breadcrumbs=array('Ticket Report');
?>
<script>
    function getNumFromStr(str)
    {
       var pattern = /[0-9]+/;
       return str.match(pattern);       
    }

   $(function() {

      $(".grid-view .items thead tr th").draggable({ revert: true });;

      $(".grid-view .items thead tr th").droppable({

          drop: function (event, ui) {
              var destination = getNumFromStr(this.id);
              var source = getNumFromStr(ui.draggable[0].id);
              $.get("", { sourceColumn: source, destinationColumn: destination });
              location.reload(true);
            
           /*  jQuery('#ticket-grid').yiiGridView({
                  'ajaxUpdate': false,
                  'ajaxVar': 'ajax', 'pagerClass': 'pagination', 'loadingClass': 'grid-view-loading', 'filterClass': 'filters', 'tableClass': 'items table table-striped table-condensed', 'selectableRows': 1, 'enableHistory': false, 'updateSelector': '{page}, {sort}', 'filterSelector': '{filter}'
              });*/
           
             /* jQuery(function ($) {
                  if ($.fn.editable) $.extend($.fn.editable.defaults, { 'emptytext': 'Click to edit', 'mode': 'inline' });
                  
                  jQuery('body').tooltip({ 'selector': 'a[rel=tooltip]' });
                  jQuery('body').popover({ 'selector': 'a[rel=popover]' });
              });*/
              /*]]>*/



              /* $.get("reportTicket", function (data) {
                  $(".result").html(data);
                  alert("Load was performed.");
              });*/

             /* jQuery.ajax({
                  url: 'index.php/reportTicket',
                  type: "GET",
                  data: { ajaxData: destination },
                  error: function (xhr, tStatus, e) {
                      if (!xhr) {
                          alert(" We have an error ");
                          alert(tStatus + "   " + e.message);
                      } else {
                          alert("else: " + e.message); // the great unknown
                      }
                  },
                  success: function (resp) {
                      alert("ff");
                  }
              });*/
          
      }

    });

  });
    // class="draggable droppable"
  </script>
<h2>Ticket Report</h2> 
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
         padding-top:0px !important;
      }

    .summary {
        text-align:left !important;
    }

    .uneditable-input {
      height:30px !important;
    }

    textarea,
input[type="text"],
input[type="password"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
.uneditable-input {
 height:30px !important;
}

</style>
<?php 


      function getTicketColumns($model)
      {
          $columns = Yii::app()->session['TicketColumnOrder'];
          
          if (!isset($columns))
          {
           $columns = array();
         
         
         //ticket ID
         $ticketID =  array('name'  => 'ticketID',
                            'header'=> 'Ticket #',
                            'filter'=> CHtml::activeNumberField($model, 'ticketID'),
                            'headerHtmlOptions' => array('width'=>'75', ));
         $columns[] = $ticketID;
         
         //creator Name
         $creatorName =  array('name'  => 'creatorName',
                               'header'=> 'Creator Name',
                               'filter'=> CHtml::activeTextField($model, 'creatorName'),
                               'headerHtmlOptions' => array('width'=>'200', ));
         $columns[] = $creatorName;
         
         //creator ID
         $creatorID =  array('name'  => 'creatorID',
                             'header'=> 'Creator ID',
                             'filter'=> CHtml::activeNumberField($model, 'creatorID'),
                             'headerHtmlOptions' => array('width'=>'75', ));
         $columns[] = $creatorID;
         
         //creator Disabled
         $creatorDisabled = array('name'  => 'creatorDisabled',
                                  'header'=> 'Creator Disabled',
                                  'value' => 'ReportUtils::getZeroOneToYesNo($data->creatorDisabled)',
                                  'filter'=> array('1'=>'Yes','0'=>'No'),
                                  'headerHtmlOptions' => array('width'=>'80', ));
         $columns[] = $creatorDisabled;
         
         //creator Email
         $creatorEmail = array('name'  => 'creatorEmail',
                               'header'=> 'Creator Email',
                               'filter'=> CHtml::activeEmailField($model, 'creatorEmail'),
                               'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $creatorEmail;
         
         
         
         //ticket status
         $ticketStatus = array('name'  => 'ticketStatus',
                               'header'=> 'Ticket Status',
                               'filter'=> array('Close'=>'Close','Pending'=>'Pending'),
                               'headerHtmlOptions' => array('width'=>'105', ));
         $columns[] = $ticketStatus;
         
         
         
         
         //ticket created date
         $ticketCreatedDate = array('name'  => 'ticketCreatedDate',
                                    'header'=> 'Created Date',
                                    'value'=>'ReportUtils::dateformat($data->ticketCreatedDate)',
                                    'filter'=> CHtml::activeDateField($model, 'ticketCreatedDate'),
                                    'headerHtmlOptions' => array('width'=>'160', ));
         $columns[] = $ticketCreatedDate; 
         
         
         //ticket assigned to user name
         $assignedToName =    array('name'  => 'assignedUserName',
                                    'header'=> 'Assigned To (Name)',
                                    'filter'=> CHtml::activeTextField($model, 'assignedUserName'),
                                    'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $assignedToName; 
      
         //ticket assigned to user ID
         $assignedToID =    array('name'  => 'ticketAssignUserID',
                                  'header'=> 'Assigned To (Id)',
                                  'filter'=> CHtml::activeNumberField($model, 'ticketAssignUserID'),
                                  'headerHtmlOptions' => array('width'=>'100', ));
         $columns[] = $assignedToID; 
         
         
         //ticket assigned to user disabled
         $assignedToDisabled =    array('name'  => 'assignedUserDisabled',
                                  'header'=> 'Assigned To (Disabled)',
                                  'value' => 'ReportUtils::getZeroOneToYesNo($data->assignedUserDisabled)',
                                  'filter'=> array('1'=>'Yes','0'=>'No'),
                                  'headerHtmlOptions' => array('width'=>'100', ));
         $columns[] = $assignedToDisabled; 
         
         
         //ticket assigned to user disabled
         $assignedToEmail =    array('name'  => 'assignedUserEmail',
                                    'header'=> 'Assigned To (Email)',
                                    'filter'=> CHtml::activeEmailField($model, 'assignedUserEmail'),
                                    'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $assignedToEmail; 
         
         //ticket dommain
         $ticketDomain =    array('name'  => 'ticketDomainName',
                                  'header'=> 'Ticket Domain',
                                  'filter'=> CHtml::activeDropDownList($model,
                                                                       'ticketDomainID',
                                                                       CHtml::listData(Domain::model()->findAll(),'id', 'name'),
                                                                       array('empty'=>' ')),
                                  'headerHtmlOptions' => array('width'=>'200', ));
         $columns[] = $ticketDomain; 
         
         
         //ticket subdomain
         $ticketSubDomain =    array('name'  => 'ticketSubDomainName',
                                    'header'=> 'Ticket Sub Domain',
                                    'filter'=> CHtml::activeDropDownList($model,
                                                                       'ticketSubDomainID',
                                                                        CHtml::listData(Subdomain::model()->findAll(),'id', 'name'),
                                                                        array('empty'=>' ')),
                                    'headerHtmlOptions' => array('width'=>'170', ));
         $columns[] = $ticketSubDomain; 
         
         
         //ticket priority
         $ticketPriority =    array('name'  => 'ticketPriorityDescription',
                                    'header'=> 'Ticket Priority',
                                    'filter'=> CHtml::activeDropDownList($model,
                                                                       'ticketPriorityID',
                                                                        CHtml::listData(Priority::model()->findAll(),'id', 'description'),
                                                                        array('empty'=>' ')),
                                    'headerHtmlOptions' => array('width'=>'110', ));
         $columns[] = $ticketPriority; 
         
         
        //ticket ticketAssignedDate
         $ticketAssignedDate =  array('name'  => 'ticketAssignedDate',
                                    'header'=> 'Ticket Assigned Date',
                                    'value'=>'ReportUtils::dateformat($data->ticketAssignedDate)',
                                    'filter'=> CHtml::activeDateField($model, 'ticketAssignedDate'),
                                    'headerHtmlOptions' => array('width'=>'160', ));
         $columns[] = $ticketAssignedDate; 
         
         
        //ticket closed date
         $ticketClosedDate = array('name'  => 'ticketClosedDate',
                                    'header'=> 'Ticket Closed Date',
                                    'value'=>'ReportUtils::dateformat($data->ticketClosedDate)',
                                    'filter'=> CHtml::activeDateField($model, 'ticketClosedDate'),
                                    'headerHtmlOptions' => array('width'=>'160', ));
         $columns[] = $ticketClosedDate; 
         
        //ticket excalated
         $ticketIsEscalated = array('name'  => 'ticketIsEscalated',
                                    'header'=> 'Escalated',
                                    'value' => 'ReportUtils::getZeroOneToYesNo($data->ticketIsEscalated)',
                                    'filter'=> array('1'=>'Yes','0'=>'No'),
                                    'headerHtmlOptions' => array('width'=>'80', ));
         $columns[] = $ticketIsEscalated; 
                  
         
        //ticket subject
         $ticketSubject =  array('name'  => 'ticketSubject',
                                 'header'=> 'Subject',
                                 'filter'=> CHtml::activeTextField($model, 'ticketSubject'),
                                 'headerHtmlOptions' => array('width'=>'300', ));
         $columns[] = $ticketSubject; 
         
        //ticket description
         $ticketDescription = array('name'  => 'ticketDescription',
                                    'header'=> 'Description',
                                    'filter'=> CHtml::activeTextField($model, 'ticketDescription'),
                                    'headerHtmlOptions' => array('width'=>'400', ));
         $columns[] = $ticketDescription; 
         }
          
          
          //only if make a cache of the columns if needed
        if (isset($_GET['sourceColumn']) && isset($_GET['destinationColumn']))
         {
             
             $source = $_GET['sourceColumn'] ;
             $destination = $_GET['destinationColumn'];
             
            
             $sourceIndex = $source[0];
             $destIndex   = $destination[0];
             
             
                   
             
             $tmpDest = $columns[$destIndex];
             $columns[$destIndex] = $columns[$sourceIndex];
             $columns[$sourceIndex] = $tmpDest;        
             
             
             Yii::app()->session['TicketColumnOrder'] = $columns;
         }
                   
        
         
         return $columns;
      }
      
   

      
      

      
      $this->widget('bootstrap.widgets.TbGridView', 
                    array('id'=>'ticket-grid', 
                          'ajaxUpdate'=>false,
                          'type'=>'striped condensed',
                          'template' => '{items}{summary}',
                          'dataProvider'=> $model->search(),
                          'enablePagination' => false,
                          'filter'=>$model,
                          'columns' =>getTicketColumns($model) ));
                          
?>