<?php if (!is_null($personalHistory)) { ?>
<div class ='well'>
<h3>Personal Pick History</h3>
<?php
		$this->widget('bootstrap.widgets.TbGridView', array(
		'type'=>'striped condensed hover',	
	    //'id' => 'personal_history',
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $personalHistory,
		'columns'=>array(
						//'id',
						//'app_id',
						array(
								'value'=>'$data["fname"] . " " . $data["lname"]', 
								'header'=>'Mentee Name',
						),
						//'user_id',
						array(
								'value'=>'$data["approval_status"]', 
								'header'=>'Approval Status',
						),			
				
				),
		));
}?>
</div>

<?php if (!is_null($projectHistory)) {?>
<div class ='well'>
<h3>Project Pick History</h3>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'project_history',
		'type'=>'striped condensed hover',
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $projectHistory,
		'columns'=>array(
						//'id',
						//'app_id',
						array(
								'value'=>'$data["title"]',
								'header'=>'Project Title',
						),array(
								'value'=>'$data["approval_status"]',
								'header'=>'Approval Status',
						),				
				),
		));
}?>
</div>

<?php if (!is_null($domainHistory)) {?>
<div class ='well'>
<h3>Domain Pick History</h3>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'domain_history',    
		'type'=>'striped condensed hover',
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $domainHistory,
		'columns'=>array(
						'id',
						//'app_id',
						array(
								'value'=>'$data["name"]',
								'header'=>'Domain',
						),array(
								'value'=>'$data["proficiency"]',
								'header'=>'Proficiency',
						),array(
								'value'=>'$data["approval_status"]',
								'header'=>'Approval Status',
						),
			),
		)); 
}?>
</div>

<?php	if (!is_null($domainHistory)) {?>
<div class ='well'>
<h3>Subdomain Pick History</h3>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'subdomain_history',
		'type'=>'striped condensed hover',
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $subdomainHistory,
		'columns'=>array(
						//'id',
						//'app_id',						
						array(
								'value'=>'$data["dname"]', 
								'header'=>'Domain',
						),array(
								'value'=>'$data["sname"]', 
								'header'=>'Subdomain',
						),array(
								'value'=>'$data["proficiency"]', 
								'header'=>'Proficiency',
						),array(
								'value'=>'$data["approval_status"]', 
								'header'=>'Approval Status',
						),
			),
)); 
}?>
</div>