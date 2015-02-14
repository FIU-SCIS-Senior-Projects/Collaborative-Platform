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

      $(".grid-view .items thead tr th").draggable({ });;

      $(".grid-view .items thead tr th").droppable({

          drop: function (event, ui) {
              var destination = getNumFromStr(this.id);
              var source = getNumFromStr(ui.draggable[0].id);
              $.get("", { sourceColumn: source, destinationColumn: destination });
              location.reload(true);
          }

    });

  });
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


abstract class TicketReportColumns
{
    const ticketID = 0;
    const creatorName = 1;
    const creatorID = 2;
    const creatorDisabled= 3;
    const creatorEmail = 4;
    const ticketStatus = 5;
    const ticketCreatedDate = 6;
    const assignedUserName = 7;
    const ticketAssignUserID = 8;
    const assignedUserDisabled = 9;
    const assignedUserEmail = 10;
    const ticketDomainName = 11;
    const ticketSubDomainName = 12;
    const ticketPriorityDescription = 13;
    const ticketAssignedDate = 14;
    const ticketClosedDate = 15;
	const ticketIsEscalated = 16;
	const ticketSubject = 17;
	const ticketDescription = 18;

}

function getColumnArrayOrder()
{
    $columns =  Yii::app()->session['TicketColumnOrder'];
    if (!isset($columns))
    {
        
       $columns = array( TicketReportColumns::ticketID,
    TicketReportColumns::creatorName,
    TicketReportColumns::creatorID,
    TicketReportColumns::creatorDisabled,
    TicketReportColumns::creatorEmail,
    TicketReportColumns::ticketStatus,
    TicketReportColumns::ticketCreatedDate,
    TicketReportColumns::assignedUserName,
    TicketReportColumns::ticketAssignUserID,
    TicketReportColumns::assignedUserDisabled,
    TicketReportColumns::assignedUserEmail,
    TicketReportColumns::ticketDomainName,
    TicketReportColumns::ticketSubDomainName,
    TicketReportColumns::ticketPriorityDescription,
    TicketReportColumns::ticketAssignedDate,
    TicketReportColumns::ticketClosedDate ,
	TicketReportColumns::ticketIsEscalated,
	TicketReportColumns::ticketSubject,
	TicketReportColumns::ticketDescription );            
    }
    
    return $columns;    
}


      function getTicketColumns($model)
      {
          //get or initialize the current column order
          $columnArrayOrder = getColumnArrayOrder();
          
        //only if make a cache of the columns if needed
        if (isset($_GET['sourceColumn']) && isset($_GET['destinationColumn']))
        {
            $source = $_GET['sourceColumn'] ;
            $destination = $_GET['destinationColumn'];
        
        
            $sourceIndex = $source[0];
            $destIndex   = $destination[0];
        
            ReportUtils::moveColumnsByIndex($sourceIndex,$destIndex,$columnArrayOrder);             
        
            Yii::app()->session['TicketColumnOrder'] = $columnArrayOrder;
         }

        
        $columns = array();
        
        for ($i = 0; $i < count($columnArrayOrder); $i++ )
        {
         
            
            
             switch ($columnArrayOrder[$i]) 
             {
                 
                 case TicketReportColumns::ticketID:
                     $columns[] =  array('name'  => 'ticketID',
                            'header'=> 'Ticket #',
                            'filter'=> CHtml::activeNumberField($model, 'ticketID'),
                            'headerHtmlOptions' => array('width'=>'75', ));
                     break;
         
                 case TicketReportColumns::creatorName:
                     $columns[] =  array('name'  => 'creatorName',
                               'header'=> 'Creator Name',
                               'filter'=> CHtml::activeTextField($model, 'creatorName'),
                               'headerHtmlOptions' => array('width'=>'200', ));
                     break;
         
                 case TicketReportColumns::creatorID:
                    $columns[] = array('name'  => 'creatorID',
                             'header'=> 'Creator ID',
                             'filter'=> CHtml::activeNumberField($model, 'creatorID'),
                             'headerHtmlOptions' => array('width'=>'75', ));
                    break;
         
                 case TicketReportColumns::creatorDisabled:
                     $columns[] = array('name'  => 'creatorDisabled',
                                  'header'=> 'Creator Disabled',
                                  'value' => 'ReportUtils::getZeroOneToYesNo($data->creatorDisabled)',
                                  'filter'=> array('1'=>'Yes','0'=>'No'),
                                  'headerHtmlOptions' => array('width'=>'80', ));
                     break;
         
                 case TicketReportColumns::creatorEmail:
                    $columns[] =array('name'  => 'creatorEmail',
                               'header'=> 'Creator Email',
                               'filter'=> CHtml::activeEmailField($model, 'creatorEmail'),
                               'headerHtmlOptions' => array('width'=>'150', ));
                    break;
         
                 case TicketReportColumns::ticketStatus:
                     $columns[] = array('name'  => 'ticketStatus',
                               'header'=> 'Ticket Status',
                               'filter'=> array('Close'=>'Close','Pending'=>'Pending'),
                               'headerHtmlOptions' => array('width'=>'105', ));
                     break;
                     
                 case TicketReportColumns::ticketCreatedDate:
                    $columns[] =  array('name'  => 'ticketCreatedDate',
                                    'header'=> 'Created Date',
                                    'value'=>'ReportUtils::dateformat($data->ticketCreatedDate)',
                                    'filter'=> CHtml::activeDateField($model, 'ticketCreatedDate'),
                                    'headerHtmlOptions' => array('width'=>'160', ));
                    break;
                    
                 case TicketReportColumns::assignedUserName:
                     $columns[] = array('name'  => 'assignedUserName',
                                    'header'=> 'Assigned To (Name)',
                                    'filter'=> CHtml::activeTextField($model, 'assignedUserName'),
                                    'headerHtmlOptions' => array('width'=>'150', ));
                     break;
                     
                 case TicketReportColumns::ticketAssignUserID:
                      $columns[] =  array('name'  => 'ticketAssignUserID',
                                  'header'=> 'Assigned To (Id)',
                                  'filter'=> CHtml::activeNumberField($model, 'ticketAssignUserID'),
                                  'headerHtmlOptions' => array('width'=>'100', ));
                      break;
                      
                 case TicketReportColumns::assignedUserDisabled:
                      $columns[] =  array('name'  => 'assignedUserDisabled',
                                  'header'=> 'Assigned To (Disabled)',
                                  'value' => 'ReportUtils::getZeroOneToYesNo($data->assignedUserDisabled)',
                                  'filter'=> array('1'=>'Yes','0'=>'No'),
                                  'headerHtmlOptions' => array('width'=>'100', ));
                      break;
                      
                 case TicketReportColumns::assignedUserEmail:
                     $columns[] =  array('name'  => 'assignedUserEmail',
                                    'header'=> 'Assigned To (Email)',
                                    'filter'=> CHtml::activeEmailField($model, 'assignedUserEmail'),
                                    'headerHtmlOptions' => array('width'=>'150', ));
                     break;
         
                 case TicketReportColumns::ticketDomainName:
                     $columns[] =array('name'  => 'ticketDomainName',
                                  'header'=> 'Ticket Domain',
                                  'filter'=> CHtml::activeDropDownList($model,
                                                                       'ticketDomainID',
                                                                       CHtml::listData(Domain::model()->findAll(),'id', 'name'),
                                                                       array('empty'=>' ')),
                                  'headerHtmlOptions' => array('width'=>'200', ));
                     break;
                     
                     
                 case TicketReportColumns::ticketSubDomainName:
                       $columns[] =    array('name'  => 'ticketSubDomainName',
                                    'header'=> 'Ticket Sub Domain',
                                    'filter'=> CHtml::activeDropDownList($model,
                                                                       'ticketSubDomainID',
                                                                        CHtml::listData(Subdomain::model()->findAll(),'id', 'name'),
                                                                        array('empty'=>' ')),
                                    'headerHtmlOptions' => array('width'=>'170', ));
                       break;
                       
                 case TicketReportColumns::ticketPriorityDescription:
                     $columns[] =    array('name'  => 'ticketPriorityDescription',
                                    'header'=> 'Ticket Priority',
                                    'filter'=> CHtml::activeDropDownList($model,
                                                                       'ticketPriorityID',
                                                                        CHtml::listData(Priority::model()->findAll(),'id', 'description'),
                                                                        array('empty'=>' ')),
                                    'headerHtmlOptions' => array('width'=>'110', ));
                     break; 
         
                 case TicketReportColumns::ticketAssignedDate:
                     $columns[] =  array('name'  => 'ticketAssignedDate',
                                    'header'=> 'Ticket Assigned Date',
                                    'value'=>'ReportUtils::dateformat($data->ticketAssignedDate)',
                                    'filter'=> CHtml::activeDateField($model, 'ticketAssignedDate'),
                                    'headerHtmlOptions' => array('width'=>'160', ));
                     break;
                     
                 case TicketReportColumns::ticketClosedDate:
                       $columns[] =  array('name'  => 'ticketClosedDate',
                                    'header'=> 'Ticket Closed Date',
                                    'value'=>'ReportUtils::dateformat($data->ticketClosedDate)',
                                    'filter'=> CHtml::activeDateField($model, 'ticketClosedDate'),
                                    'headerHtmlOptions' => array('width'=>'160', ));
                       break;
                       
                 case TicketReportColumns::ticketIsEscalated:
                        $columns[]  = array('name'  => 'ticketIsEscalated',
                                    'header'=> 'Escalated',
                                    'value' => 'ReportUtils::getZeroOneToYesNo($data->ticketIsEscalated)',
                                    'filter'=> array('1'=>'Yes','0'=>'No'),
                                    'headerHtmlOptions' => array('width'=>'80', ));
                        break;
                        
                 case TicketReportColumns::ticketSubject:
                        $columns[]  =  array('name'  => 'ticketSubject',
                                 'header'=> 'Subject',
                                 'filter'=> CHtml::activeTextField($model, 'ticketSubject'),
                                 'headerHtmlOptions' => array('width'=>'300', ));
                        break;
                        
                  case TicketReportColumns::ticketDescription: 
                        $columns[] = array('name'  => 'ticketDescription',
                                    'header'=> 'Description',
                                    'filter'=> CHtml::activeTextField($model, 'ticketDescription'),
                                    'headerHtmlOptions' => array('width'=>'400', ));
                        break;
             }
         
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