-- New events
INSERT INTO ticket_events (event_type_id,ticket_id,event_recorded_date,old_value,new_value,comment,event_performed_by_user_id)
SELECT 1, ticket.id, ticket.created_date, NULL, NULL, NULL, creator_user_id
FROM ticket
LEFT JOIN (SELECT *
           FROM ticket_events
           WHERE ticket_events.event_type_id = 1 ) p   ON ticket.id = p.ticket_id
where p.ticket_id IS NULL

-- there is not much more that can be inserted, because the is a lack of data  recorded so far



      
