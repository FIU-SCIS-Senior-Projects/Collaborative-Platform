<?php
/* @var $this ApplicationDomainMentorController */
/* @var $model ApplicationDomainMentor */
/* @var $domainHistory  */
/* @var $domainChanges  */
/* @var $subdomainHistory  */
/* @var $subdomainChanges  */

?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'status',
		'date_created',
		'max_amount',
		'max_hours',
	),
)); ?>
<hr>
<h4>Domain Picks</h4>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'domain_picks',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $domainChanges,
		'columns'=>array(
						'id',
						'app_id',
						'proficiency',
						'domain_id',
						array(
								'class' => 'editable.EditableColumn',
								'name' => 'approval_status',
								'header'=> 'Approval Status',
								//'headerHtmlOptions' => array('style' => 'width: 110px'),
								'editable' => array(    //editable section
										'type'     => 'select',
										//'mode'=>'popup',
										//'apply'      => '$data->approval_status != "Rejected"', //can't edit deleted users
										'url'        => $this->createUrl('applicationDomainMentor/updateDomainPick'),
										'placement'  => 'right',
										'source'    => Editable::source(array('Proposed by Mentor'=> 'Proposed by Mentor',
																					'Approved' => 'Approved', 
																						'Rejected' => 'Rejected')),
										
								)
						),	
			),
)); 
?>
<hr>
<h5>History</h5>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'domain_picks',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $domainHistory,
		'columns'=>array(
						'id',
						'app_id',
						'proficiency',
						'domain_id',
						'approval_status',
			),
)); 
?>
<h4>Sub-Domain Picks</h4>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'personal_picks',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $subdomainChanges,
		'columns'=>array(
						'id',
						'app_id',
						'proficiency',
						'subdomain_id',
						array(
								'class' => 'editable.EditableColumn',
								'name' => 'approval_status',
								'header'=> 'Approval Status',
								//'headerHtmlOptions' => array('style' => 'width: 110px'),
								'editable' => array(    //editable section
										'type'     => 'select',
										//'mode'=>'popup',
										//'apply'      => '$data->approval_status != "Rejected"', //can't edit deleted users
										'url'        => $this->createUrl('applicationDomainMentor/updateSubdomainPick'),
										'placement'  => 'right',
										'source'    => Editable::source(array('Proposed by Mentor'=> 'Proposed by Mentor',
																					'Approved' => 'Approved', 
																						'Rejected' => 'Rejected')),
										
								)
						),
						
			),
)); 
?>
<h5>History</h5>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'domain_picks',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $subdomainHistory,
		'columns'=>array(
						'id',
						'app_id',
						'proficiency',
						'subdomain_id',
						'approval_status',
			),
)); 
?>

