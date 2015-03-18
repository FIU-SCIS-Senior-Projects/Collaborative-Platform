ALTER TABLE `coplat`.`ticket` 
ADD COLUMN `assigned_project_id` INT(11) NULL AFTER `Mentor2`;

ALTER TABLE `coplat`.`ticket` 
CHANGE COLUMN `assigned_project_id` `assigned_project_id` INT(11) UNSIGNED NULL DEFAULT NULL ,
ADD INDEX `fk_assigned_project_id_idx` (`assigned_project_id` ASC);
ALTER TABLE `coplat`.`ticket` 
ADD CONSTRAINT `fk_assigned_project_id`
  FOREIGN KEY (`assigned_project_id`)
  REFERENCES `coplat`.`project` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
