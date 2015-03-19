ALTER TABLE `coplat`.`application_project_mentor_pick` 
CHANGE COLUMN `approval_status` `approval_status` ENUM('Proposed by Mentor','Proposed by Admin','Approved','Rejected','Proposed by System') NOT NULL ;
