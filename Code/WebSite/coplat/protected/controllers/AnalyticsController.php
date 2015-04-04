<?php


class AnalyticsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
        {
            return array(
                array('allow',
                    'actions'=>array('index', 'PullFrecuentMenteeSubdomains'),
                    'users'=>array('admin')),
                array('deny',  // deny all users
                    'users'=>array('*')),
            );
        }
        
        public function actionPullFrecuentMenteeSubdomains()
        {
            $associationFilter= new AssociationFilter();
            if(isset($_POST['AssociationFilter'])) 
            {
               $associationFilter->attributes = $_POST['AssociationFilter'];
               
                if ( !is_numeric($associationFilter->lowerBoundMinSupport))
                {
                   $associationFilter->lowerBoundMinSupport =  0.1; 
                }

                if ( !is_numeric($associationFilter->numRulesToFind))
                {
                   $associationFilter->numRulesToFind =  10; 
                }

               if ( !is_numeric($associationFilter->uppperBoundMinSupport))
               {
                   $associationFilter->uppperBoundMinSupport =  1.0; 
               }  
               
               
            }else
            {
               $associationFilter->setDefaultValues();
            }
            
         //  echo $associationFilter->lowerBoundMinSupport;
           
            
            
            //1 pull all the attributes (Dinstinct SubDomains used)
            $subdomainsUsedCol = Subdomain::getAllSubdomainsInUse();
            
            //2 build the attributes collection
            $attributeCol = array();
            $attributeMap = array();
            $lastAttribIndex  = count($subdomainsUsedCol) -1;
            for ($i = 0; $i <= $lastAttribIndex; $i++)
            {
               $attribKey = $subdomainsUsedCol[$i]->name;
               $attribute = new Attribute($attribKey, $i); 
               $attributeCol[] = $attribute;
               $attributeMap[$attribKey] = $attribute;
            }
                       
                                
            //3 pull all the item sets (relation of Subdomains with mentee)
            $subdomainsPerMenteeCol = AssociationFilter::retrieveSubDomainsUsedPerMentee();
            
            //4 build the instances
            $instancesCol = array();
            $currentCreatorID = NULL;
            $currentInstance = NULL;
            foreach ($subdomainsPerMenteeCol as $data)
            {
                if ($currentInstance == NULL ||  $currentCreatorID !=  ArrayUtils::getValueOrDefault($data, "MenteeUserID",0))
                {
                    $currentCreatorID = ArrayUtils::getValueOrDefault($data, "MenteeUserID",0);
                    $currentInstance  = new Instance($lastAttribIndex + 1);
                    $instancesCol[] = $currentInstance;
                }   
                
                $attribKey = ArrayUtils::getValueOrDefault($data, "SubDomainName",0);
                $currentInstance->setValue($attributeMap[$attribKey] ,1);
            }
            $instances = new Instances($attributeCol,$instancesCol);
                   
            //5 calculate the association rules
            $fpGrowth = new FPGrowth();
            $fpGrowth->m_numRulesToFind = $associationFilter->numRulesToFind;
            $fpGrowth->m_upperBoundMinSupport =  $associationFilter->uppperBoundMinSupport;
            $fpGrowth->lowerBoundMinSupport = $associationFilter->lowerBoundMinSupport;
          
          
            
            
            $fpGrowth->buildAssociations($instances);
            
            //6 render the association rules
            $rules = $fpGrowth->getRules();
            
            $associations = array();
            $id = 0;
            foreach ($rules as $rule)
            {
                $associations[] = array("id" => $id,
                                        "Operator" => " ==> ",
                                        "Premise" => $this->renderBinaryItemsCommaSeparated($rule->getPremise()),
                                        "Consequence"  =>$this->renderBinaryItemsCommaSeparated($rule->getConsequence()) );
                //echo $this->renderBinaryItemsCommaSeparated($rule->getPremise()). " ==> ".$this->renderBinaryItemsCommaSeparated($rule->getConsequence()). "</br>";                
                $id++;
            } 
              
            $dataProvider=new CArrayDataProvider($associations, array('pagination'=> false));
            $this->render("frecuentMenteeSubdomains", array('dataprovider' => $dataProvider, 
                                                            'filter' => $associationFilter));
        }
        
        private function renderBinaryItemsCommaSeparated($binaryItems)
        {
           $res = "";
           $separator = "";
           foreach ($binaryItems as $binaryItm)
           {
            $res = $res.$separator.$binaryItm->getAttribute()->name();
            $separator = ", ";
           }     
           return $res;
        }
        
        
    
        

}
