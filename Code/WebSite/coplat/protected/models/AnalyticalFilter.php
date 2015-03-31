<?php
    class AnalyticalFilter extends CFormModel
    {
        
        public function retrieveSubDomainsUsedPerMentee()
        {
            $subdomainsUsedByMenteeCommand = Yii::app()->db->createCommand();
            $subdomainsUsedByMenteeCommand->distinct = true;
            $subdomainsUsedByMenteeCommand->select("subdomain.id AS SubDomainID, subdomain.name AS SubDomainName, ticket.creator_user_id AS MenteeUserID");
            $subdomainsUsedByMenteeCommand->from("subdomain");
            $subdomainsUsedByMenteeCommand->join("ticket","ticket.subdomain_id = subdomain.id");
            $subdomainsUsedByMenteeCommand->order("ticket.creator_user_id");
            return $subdomainsUsedByMenteeCommand->queryAll();
           // echo $subdomainsUsedByMenteeCommand->text;
          // "SELECT DISTINCT subdomain.id AS SubDomainID, subdomain.name AS SubDomainName, ticket.creator_user_id AS MenteeUserID  FROM subdomain INNER JOIN ticket ON ticket.subdomain_id = subdomain.id ORDER BY ticket.creator_user_id"
        }

    }
?>
