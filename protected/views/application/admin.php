<?php
/* @var $this ApplicationController */
/* @var $model Application */

$this->breadcrumbs=array(
	'Manage Applications',
);

?>

<h1>Manage Applications</h1>

<?php 

	$rawData = new CSqlDataProvider('Select id , a.date_created, fname, lname from (SELECT * FROM                                      
			( 
			    (SELECT user_id, date_created FROM application_domain_mentor WHERE status="Admin")
			    UNION
			    (SELECT user_id, date_created FROM application_personal_mentor WHERE status="Admin")
			    UNION 
			    (SELECT user_id, date_created FROM application_project_mentor WHERE status="Admin")
			) as c GROUP BY c.user_id) 
											a, user u WHERE a.user_id = u.id ORDER BY a.date_created DESC');

	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'application-grid',
	'dataProvider'=>$rawData,
	'summaryText'=>'',
	'columns'=>array(
				array(
                   	'header'=>'User',
					'value'=>'$data["fname"] . " " . $data["lname"]',                 						
                 ),
				array(
					'header'=>'Date Created',
					'value'=>'$data["date_created"]'				
				),			
				array(
					'header'=>'Options',
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'template'=> '{view}',
					'buttons'=>array(
							'view'=>
							array(
									'url'=>'Yii::app()->createUrl("application/view", array("id"=>$data["id"]))',
										
							),
					),
			),
		
			),
)); ?>
