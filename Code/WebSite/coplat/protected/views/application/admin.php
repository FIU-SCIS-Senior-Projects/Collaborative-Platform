<?php
/* @var $this ApplicationController */
/* @var $model Application */

$this->breadcrumbs=array(
	'Manage Applications',
);

?>

<h1>Manage Applications</h1>

<?php 

	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'application-grid',
	'dataProvider'=>$dataprovider,
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
