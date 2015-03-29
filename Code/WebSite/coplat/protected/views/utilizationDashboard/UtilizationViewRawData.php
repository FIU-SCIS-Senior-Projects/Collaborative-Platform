<style type="text/css">
.table {table-layout: fixed;}
.summary {text-align:left !important;}
</style>
<?php 
      function getColumns($ultilizationFilter)
      {
        
       $columns = array();  

       switch ($ultilizationFilter->reportTypeId)
        {
           case ReportType::TicketsAVGDuration:
            $columns[] =  array('name'  => 'HourLifeSpan',
                                'header'=> 'Duration (hours)',
                                 'headerHtmlOptions' => array('width'=>'75', ));       
               break;   


           case ReportType::TicketsAVGTimeMentorAnswer:
            $columns[] =  array('name'  => 'HourAnswered',
                                'header'=> 'Time to answer (hours)',
                                'headerHtmlOptions' => array('width'=>'120', ));       
               break;  

            case ReportType::TicketsCurrentlyOpen:
			     
			 $columns[] =  array('name'  => 'OpenedSince',
                                'header'=> 'Opened Since (hours)',
                                'headerHtmlOptions' => array('width'=>'120', ));       
               break;  
			   
			case ReportType::TicketsUnanswered:
             $columns[] =  array('name'  => 'OpenedSince',
                                'header'=> 'Opened Since (hours)',
                                'headerHtmlOptions' => array('width'=>'120', ));       
               break;  
			

			   
          
         }	   



	   
       $columns[] =  array('name'  => 'ticketID',
                            'header'=> 'Ticket #',
                            'headerHtmlOptions' => array('width'=>'75', ));
	    $columns[] =  array('name'  => 'creatorName',
                            'header'=> 'Creator Name',
                            'headerHtmlOptions' => array('width'=>'200', ));
        $columns[] = array('name'  => 'creatorID',
                             'header'=> 'Creator ID',
                             'headerHtmlOptions' => array('width'=>'75', ));
							 
        $columns[] = array('name'  => 'creatorDisabled',
						    'header'=> 'Creator Disabled',
						    'value' => 'ReportUtils::getZeroOneToYesNo($data["creatorDisabled"])',
						    'headerHtmlOptions' => array('width'=>'80', ));
        $columns[] =array('name'  => 'creatorEmail',
                          'header'=> 'Creator Email',
                          'headerHtmlOptions' => array('width'=>'150', ));
        $columns[] = array('name'  => 'ticketStatus',
                           'header'=> 'Ticket Status',
                           'headerHtmlOptions' => array('width'=>'105', ));
        $columns[] =  array('name'  => 'ticketCreatedDate',
                                    'header'=> 'Created Date',
                                    'value'=>'ReportUtils::dateformat($data["ticketCreatedDate"])',
                                    'headerHtmlOptions' => array('width'=>'160', ));
        $columns[] = array('name'  => 'assignedUserName',
                                    'header'=> 'Assigned To (Name)',
                                    'headerHtmlOptions' => array('width'=>'150', ));
        $columns[] =  array('name'  => 'ticketAssignUserID',
                                  'header'=> 'Assigned To (Id)',
                                  'headerHtmlOptions' => array('width'=>'100', ));
        $columns[] =  array('name'  => 'assignedUserDisabled',
                                  'header'=> 'Assigned To (Disabled)',
                                  'value' => 'ReportUtils::getZeroOneToYesNo($data["assignedUserDisabled"])',
                                  'headerHtmlOptions' => array('width'=>'100', ));
        $columns[] =  array('name'  => 'assignedUserEmail',
                                    'header'=> 'Assigned To (Email)',
                                    'headerHtmlOptions' => array('width'=>'150', ));
        $columns[] =array('name'  => 'ticketDomainName',
                                  'header'=> 'Ticket Domain',
                                  'headerHtmlOptions' => array('width'=>'200', ));
       $columns[] =    array('name'  => 'ticketSubDomainName',
                                    'header'=> 'Ticket Sub Domain',
                                    'headerHtmlOptions' => array('width'=>'170', ));
       $columns[] =    array('name'  => 'ticketPriorityDescription',
                                    'header'=> 'Ticket Priority',
                                    'headerHtmlOptions' => array('width'=>'110', ));
       $columns[] =  array('name'  => 'ticketAssignedDate',
                                    'header'=> 'Ticket Assigned Date',
                                    'value'=>'ReportUtils::dateformat($data["ticketAssignedDate"])',
                                    'headerHtmlOptions' => array('width'=>'160', ));
       $columns[] =  array('name'  => 'ticketClosedDate',
                                    'header'=> 'Ticket Closed Date',
                                    'value'=>'ReportUtils::dateformat($data["ticketClosedDate"])',
                                    'headerHtmlOptions' => array('width'=>'160', ));
       $columns[]  = array('name'  => 'ticketIsEscalated',
                                    'header'=> 'Escalated',
                                    'value' => 'ReportUtils::getZeroOneToYesNo($data["ticketIsEscalated"])',
                                    'headerHtmlOptions' => array('width'=>'80', ));
       $columns[]  =  array('name'  => 'ticketSubject',
                                 'header'=> 'Subject',
                                 'headerHtmlOptions' => array('width'=>'300', ));
      $columns[] = array('name'  => 'ticketDescription',
                                    'header'=> 'Description',
                                    'headerHtmlOptions' => array('width'=>'400', ));/**/
		 return $columns;
      }
      
     
      $this->widget('bootstrap.widgets.TbGridView', 
                    array('id'=>'utilizationGrid', 
                          'ajaxUpdate'=>true,
                          'type'=>'striped condensed',
                          'template' => '{items}{summary}',
                          'dataProvider'=> $dataprovider,
						  'enablePagination' => false,
						  'columns' =>getColumns($ultilizationFilter)));
                          
?>