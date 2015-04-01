<?php


class AnalyticalController extends Controller
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
                    'actions'=>array('index', 'PullFrecuentMentorSubdomains'),
                    'users'=>array('admin')),
                array('deny',  // deny all users
                    'users'=>array('*')),
            );
        }
        
        public function actionPullFrecuentMentorSubdomains()
        {
            //1 pull all the attributes (Dinstinct SubDomains used)
            $subdomainsUsedCol = Subdomain::getAllSubdomainsInUse();
            
            //2 build the attributes collection            
            
            //3 pull all the item sets (relation of Subdomains with mentee)
            $subdomainsPerMenteeCol = AnalyticalFilter::retrieveSubDomainsUsedPerMentee();
            
            //4 build the instances
            
            //5 calculate the association rules
            
            //6 render the association rules

        }
}

?>