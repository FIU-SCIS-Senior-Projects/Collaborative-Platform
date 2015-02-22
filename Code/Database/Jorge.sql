
use coplat;

/*
Need to add foreign key constraints
*/
drop table video_conference;

CREATE TABLE IF NOT EXISTS `video_conference` (
  `id` int(11) unsigned NOT NULL Primary Key,
  `moderator_id` int(11) unsigned NOT NULL,
  `scheduled_on` datetime, 
  `scheduled_for` datetime,
  `notes` varchar(255)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


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

ALTER TABLE vc_invitation
ADD CONSTRAINT fk_VC_Invitations
FOREIGN KEY (invitee_id)
REFERENCES user(id);




