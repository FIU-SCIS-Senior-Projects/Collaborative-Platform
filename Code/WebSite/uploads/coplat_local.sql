SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `coplat` DEFAULT CHARACTER SET utf8 ;
USE `coplat` ;

-- -----------------------------------------------------
-- Table `coplat`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`user` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User ID ',
  `username` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL COMMENT 'User Name',
  `password` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL COMMENT 'User Password',
  `email` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL COMMENT 'User Email',
  `fname` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL COMMENT 'User First Name',
  `mname` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL COMMENT 'User Middle Name',
  `lname` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL COMMENT 'User Last Name',
  `pic_url` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'User Picture Location',
  `activated` TINYINT(1) NULL DEFAULT NULL COMMENT '1: Yes 0: No',
  `activation_chain` VARCHAR(45) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'Activation String',
  `disable` TINYINT(1) NULL DEFAULT NULL COMMENT 'Profile Status 1: Enable 0: Disable',
  `biography` VARCHAR(500) NULL DEFAULT NULL,
  `linkedin_id` VARCHAR(45) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `fiucs_id` VARCHAR(45) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'FIU CS ID',
  `google_id` VARCHAR(45) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'Google ID',
  `isAdmin` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'The user is administrator',
  `isProMentor` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Project Mentor',
  `isPerMentor` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Personal Mentor',
  `isDomMentor` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Domain Mentor',
  `isStudent` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'The use is student',
  `isMentee` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Mentee',
  `isJudge` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'The user is a Judge',
  `isEmployer` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'The user is an Employeer',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username` ASC, `email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `coplat`.`administrator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`administrator` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_administrator_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_administrator_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `coplat`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`domain`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`domain` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(500) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`topic`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`topic` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `domain_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `domain_id_UNIQUE` (`domain_id` ASC),
  INDEX `fk_topic_domain1_idx` (`domain_id` ASC),
  CONSTRAINT `fk_topic_domain1`
    FOREIGN KEY (`domain_id`)
    REFERENCES `coplat`.`domain` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`ticket` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `creator_user_id` INT(11) UNSIGNED NOT NULL,
  `topic_id` INT(11) UNSIGNED NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `created_date` DATETIME NOT NULL,
  `last_updated` DATETIME NULL DEFAULT NULL,
  `subject` VARCHAR(45) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `answer` VARCHAR(500) NULL DEFAULT NULL,
  `assign_user_id` INT(11) UNSIGNED NULL,
  `ticket_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ticket_user2_idx` (`creator_user_id` ASC),
  INDEX `fk_ticket_topic1_idx` (`topic_id` ASC),
  INDEX `fk_ticket_user1_idx` (`assign_user_id` ASC),
  INDEX `fk_ticket_ticket1_idx` (`ticket_id` ASC),
  CONSTRAINT `fk_ticket_user2`
    FOREIGN KEY (`creator_user_id`)
    REFERENCES `coplat`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_topic1`
    FOREIGN KEY (`topic_id`)
    REFERENCES `coplat`.`topic` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_user1`
    FOREIGN KEY (`assign_user_id`)
    REFERENCES `coplat`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_ticket1`
    FOREIGN KEY (`ticket_id`)
    REFERENCES `coplat`.`ticket` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`attachment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`attachment` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_url` VARCHAR(255) NOT NULL,
  `ticket_id` INT(11) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_attachment_ticket1_idx` (`ticket_id` ASC),
  CONSTRAINT `fk_attachment_ticket1`
    FOREIGN KEY (`ticket_id`)
    REFERENCES `coplat`.`ticket` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`comment` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(500) NOT NULL,
  `added_date` DATETIME NOT NULL,
  `ticket_id` INT(11) UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_ticket1_idx` (`ticket_id` ASC),
  CONSTRAINT `fk_comment_ticket1`
    FOREIGN KEY (`ticket_id`)
    REFERENCES `coplat`.`ticket` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COMMENT = '				';


-- -----------------------------------------------------
-- Table `coplat`.`domain_mentor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`domain_mentor` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `max_tickets` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_domain_mentor_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_domain_mentor_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `coplat`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`invitation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`invitation` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL DEFAULT NULL,
  `status` TINYINT(1) NULL DEFAULT NULL COMMENT '1: Accepted 0: Rejected',
  `administrator_user_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_invitation_administrator1_idx` (`administrator_user_id` ASC),
  CONSTRAINT `fk_invitation_administrator1`
    FOREIGN KEY (`administrator_user_id`)
    REFERENCES `coplat`.`administrator` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`project_mentor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`project_mentor` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `max_hours` INT(11) NULL DEFAULT NULL,
  `max_projects` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_project_mentor_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_project_mentor_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `coplat`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '	';


-- -----------------------------------------------------
-- Table `coplat`.`project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`project` (
  `id` INT(11) UNSIGNED NOT NULL,
  `title` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `start_date` DATETIME NULL DEFAULT NULL,
  `due_date` VARCHAR(45) NULL DEFAULT NULL,
  `mentor_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`projectmentor_project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`projectmentor_project` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` INT(11) UNSIGNED NOT NULL,
  `project_mentor_user_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_project_mentor_has_project_project1_idx` (`project_id` ASC),
  INDEX `fk_projectmentor_project_project_mentor1_idx` (`project_mentor_user_id` ASC),
  UNIQUE INDEX `project_mentor_user_id_UNIQUE` (`project_mentor_user_id` ASC),
  UNIQUE INDEX `project_id_UNIQUE` (`project_id` ASC),
  CONSTRAINT `fk_projectmentor_project_project_mentor1`
    FOREIGN KEY (`project_mentor_user_id`)
    REFERENCES `coplat`.`project_mentor` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_mentor_has_project_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `coplat`.`project` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`mentee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`mentee` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `projectmentor_project_id` INT(11) UNSIGNED NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_mentee_projectmentor_project1_idx` (`projectmentor_project_id` ASC),
  CONSTRAINT `fk_mentee_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `coplat`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mentee_projectmentor_project1`
    FOREIGN KEY (`projectmentor_project_id`)
    REFERENCES `coplat`.`projectmentor_project` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`message` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Message ID',
  `receiver` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL COMMENT 'Receiver username',
  `sender` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL COMMENT 'Sender username',
  `message` VARCHAR(500) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'Message Body',
  `subject` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL COMMENT 'Message Subject',
  `created_date` DATETIME NOT NULL COMMENT 'Message Creation Date',
  `been_read` BIT(1) NOT NULL COMMENT '0: NO 1: YES',
  `been_deleted` BIT(1) NULL DEFAULT NULL COMMENT '0: NO 1: YES',
  PRIMARY KEY (`id`),
  INDEX `fk_message_user1_idx` (`receiver` ASC),
  INDEX `fk_message_user2_idx` (`sender` ASC),
  CONSTRAINT `fk_message_user1`
    FOREIGN KEY (`receiver`)
    REFERENCES `coplat`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_user2`
    FOREIGN KEY (`sender`)
    REFERENCES `coplat`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `coplat`.`personal_mentor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`personal_mentor` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `max_hours` VARCHAR(45) NULL DEFAULT NULL,
  `max_mentees` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_personal_mentor_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_personal_mentor_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `coplat`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`personal_meeting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`personal_meeting` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `mentee_user_id` INT(11) UNSIGNED NOT NULL,
  `personal_mentor_user_id` INT(11) UNSIGNED NOT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_personal_meeting_mentee1_idx` (`mentee_user_id` ASC),
  INDEX `fk_personal_meeting_personal_mentor1_idx` (`personal_mentor_user_id` ASC),
  CONSTRAINT `fk_personal_meeting_mentee1`
    FOREIGN KEY (`mentee_user_id`)
    REFERENCES `coplat`.`mentee` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_meeting_personal_mentor1`
    FOREIGN KEY (`personal_mentor_user_id`)
    REFERENCES `coplat`.`personal_mentor` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`project_meeting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`project_meeting` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_mentor_user_id` INT(11) UNSIGNED NOT NULL,
  `mentee_user_id` INT(11) UNSIGNED NOT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_project_meeting_project_mentor1_idx` (`project_mentor_user_id` ASC),
  INDEX `fk_project_meeting_mentee1_idx` (`mentee_user_id` ASC),
  CONSTRAINT `fk_project_meeting_mentee1`
    FOREIGN KEY (`mentee_user_id`)
    REFERENCES `coplat`.`mentee` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_meeting_project_mentor1`
    FOREIGN KEY (`project_mentor_user_id`)
    REFERENCES `coplat`.`project_mentor` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`user_domain`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`user_domain` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `domain_id` INT(11) UNSIGNED NOT NULL,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `rate` INT(11) NULL DEFAULT NULL,
  `active` TINYINT(1) NULL DEFAULT NULL,
  `tier_team` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_domain_has_user_user1_idx` (`user_id` ASC),
  INDEX `fk_domain_has_user_domain1_idx` (`domain_id` ASC),
  UNIQUE INDEX `domain_id_UNIQUE` (`domain_id` ASC),
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC),
  CONSTRAINT `fk_domain_has_user_domain1`
    FOREIGN KEY (`domain_id`)
    REFERENCES `coplat`.`domain` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_domain_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `coplat`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `coplat`.`notification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coplat`.`notification` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` INT(11) UNSIGNED NOT NULL,
  `receiver_id` INT(11) UNSIGNED NOT NULL,
  `datetime` TIME NOT NULL,
  `been_read` TINYINT(1) NOT NULL DEFAULT false,
  `message` VARCHAR(5000) NULL,
  `link` VARCHAR(150) NULL,
  `importancy` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
