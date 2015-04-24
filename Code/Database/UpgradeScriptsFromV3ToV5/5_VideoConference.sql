
use coplat;


drop table video_conference;

CREATE TABLE IF NOT EXISTS `video_conference` (
  `id` int(11) unsigned NOT NULL Primary Key AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `moderator_id` int(11) unsigned NOT NULL,
  `scheduled_on` datetime NOT NULL, 
  `scheduled_for` datetime,
  `status` varchar(45) NOT NULL DEFAULT "scheduled",
  `notes` varchar(255)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE video_conference
ADD CONSTRAINT fk_Moderator
FOREIGN KEY (moderator_id)
REFERENCES user(id);



/*
Status -> '', Maybe, Declined, Accepted
*/
drop table vc_invitation;

CREATE TABLE IF NOT EXISTS `vc_invitation` (
  `videoconference_id` int(11) unsigned NOT NULL,
  `invitee_id` int(11) unsigned NOT NULL,
  `status` varchar(32)	 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
ALTER TABLE `coplat`.`vc_invitation` 
ADD PRIMARY KEY (`videoconference_id`, `invitee_id`);
ALTER TABLE vc_invitation
ADD CONSTRAINT fk_VC_Invitations
FOREIGN KEY (invitee_id)
REFERENCES user(id);




