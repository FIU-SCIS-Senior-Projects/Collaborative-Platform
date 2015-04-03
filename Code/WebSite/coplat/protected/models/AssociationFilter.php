<?php
    class AssociationFilter extends CFormModel
    {
        
        public $lowerBoundMinSupport;
        public $numRulesToFind;
        public $uppperBoundMinSupport;
        
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
        
        public function setDefaultValues()
        {
            $this->lowerBoundMinSupport = 0.1;
            $this->numRulesToFind = 10;
            $this->uppperBoundMinSupport = 1.0;        
        }
        
        
        public function rules()
        {
            return array(
             array('lowerBoundMinSupport, numRulesToFind, uppperBoundMinSupport', 'required'),                  
            );
        }
        
        public function attributeLabels()
        {
               return array('lowerBoundMinSupport' => 'Lower bound min support',
                            'numRulesToFind' => 'Max number of rules',
                            'uppperBoundMinSupport' => 'Upper bound min support' );
        }
        
    }
    
    
?>
