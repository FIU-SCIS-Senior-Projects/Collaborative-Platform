ALTER TABLE `coplat`.`user_info` 
CHANGE COLUMN `employer` `employer` VARCHAR(50) NULL ,
CHANGE COLUMN `position` `position` VARCHAR(50) NULL ,
CHANGE COLUMN `job_start` `job_start` INT(4) UNSIGNED NULL ,
CHANGE COLUMN `degree` `degree` VARCHAR(50) NULL ,
CHANGE COLUMN `field_of_study` `field_of_study` VARCHAR(50) NULL ,
CHANGE COLUMN `university` `university` VARCHAR(60) NULL ,
CHANGE COLUMN `grad_year` `grad_year` INT(4) UNSIGNED NULL ;