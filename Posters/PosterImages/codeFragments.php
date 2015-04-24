<?php
private function retrieveTicketsClosedData()
{
   $command =  Yii::app()->db->createCommand();
   
   $command->from("ticket_events");
   $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
   $command->where("ticket_events.event_type_id = ".EventType::Event_Status_Changed);
   $command->andWhere("ticket_events.new_value = 'Close'");
                  
   switch ($this->dim2ID)
   {
	 case DimensionType::Date:
		   $command->select(array("COUNT(1) AS EventCount, 
		                           DAY(event_recorded_date) AS Day, 
								   MONTH(event_recorded_date) AS Month, 
								   YEAR(event_recorded_date)AS Year"));  
		   $command->group('DATE(ticket_events.event_recorded_date)');
	       break;            
	   case DimensionType::MonthOfTheYear:
		   $command->select(array("COUNT(1) AS EventCount, 1 AS Day ,
		                     MONTH(event_recorded_date) AS Month, 
							 YEAR(event_recorded_date) AS Year")); 
		   $command->group('YEAR(ticket_events.event_recorded_date), 
		                    MONTH(ticket_events.event_recorded_date)');
		  break;           
	   case DimensionType::Year:
		   $command->select(array("COUNT(1) AS EventCount, 1 AS Day, 1 AS Month, 
		                           YEAR(event_recorded_date) AS Year")); 
		   $command->group('YEAR(ticket_events.event_recorded_date)');
		  break;
	   case DimensionType::TicketAssignedMentor:
			 $command->select(array("COUNT(1) AS EventCount, CONCAT_WS(' ',
									`user`.`fname`,	`user`.`mname`,
									`user`.`lname`) AS MentorName")); 
			 $command->group('ticket.assign_user_id');
			 $command->join('user', 'user.id = ticket.assign_user_id');
		 break;
		case DimensionType::Mentee:
			$command->select(array("COUNT(1) AS EventCount, CONCAT_WS(' ',
									`user`.`fname`,	`user`.`mname`,
									`user`.`lname`) AS MenteeName")); 
			 $command->group('ticket.creator_user_id');
			 $command->join('user', 'user.id = ticket.creator_user_id');			
		  break;			  
		  
	   default:
		   throw new CException("Invalid dimension");
   }       
   $this->prepareAllFiltersCommand($command);
   return $command->queryAll(); 
}