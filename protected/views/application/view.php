<?php
/* @var $this ApplicationController */
/* @var $user_id UserID */

$this->breadcrumbs=array(
	'Applications'=>array('admin'),
	$user_id,
);

Yii::app()->clientScript->registerScript('application', "
$('.personal-button').click(function(){
	$('.personal-form').toggle();
	return false;
});

$('.project-button').click(function(){
	$('.project-form').toggle();
	return false;
});

$('.domain-button').click(function(){
	$('.domain-form').toggle();
	return false;
});
		

");

// $('#personal_history').on('mouseover mouseout', 'table tr', function(event) {
// 	if (event.type == 'mouseover') {
// 		$('.project-form').toggle();

// 	} else if (event.type == 'mouseout') {
// 		$('.project-form').toggle();

// 	}
// });

?>


<!-- PERSONAL MENTOR SECTION (ROUTE TO CONTROLLER) -->
<?php 	$persCount = Yii::app()->db->createCommand()->select('COUNT(*)')->
												from('application_personal_mentor')->
												where('status="Admin"')->
         										andWhere('user_id=:id', array(':id'=>$user_id))->
												queryScalar();

		if ($persCount == 1) {?>

<div class='well personal-form' style="display:none">
<h3><?php echo CHtml::link('Personal Application','#',array('class'=>'personal-button')); ?></h3>
</div>

<div class='well personal-form' style="display:">
<h3><?php echo CHtml::link('Personal Application','#',array('class'=>'personal-button')); ?></h3>
<hr>	
<?php

?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$personalMentor,
	'attributes'=>array(
		'id',
		'user_id',
		'status',
		'date_created',
		'max_amount',
		'max_hours',
		'system_pick_amount',
		'university_id',
	),
)); ?>
<hr>
<h4>Awaiting Approval</h4>
<?php 
		$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'personal_changes',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $personalMentorChanges,
		'columns'=>array(
						'id',
						'app_id',
						'fname',
						'lname',
						//'user_id',
						'approval_status',
				array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{accept} {reject}',
						'header'=>'Options',
						'buttons'=>array
						(
								'accept' => array
								(
										'label'=>'Accept',
										//'icon'=>'ok',
										'url'=>'',
										'options'=>array(
												'class'=>'btn btn-small btn-success',
										),
								),
								'reject' => array
								(
										'label'=>'Reject',
										//'icon'=>'list white',
										'url'=>'',
										'options'=>array(
												'class'=>'btn btn-small btn-danger',
										),
								),
						),
						'htmlOptions'=>array(
								'style'=>'width: 140px',
						),
				)
				
				),
		));
?>
<hr>
<h4>History</h4>
<?php 
		$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'personal_history',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $personalMentorHistory,
		'columns'=>array(
						'id',
						'app_id',
						'fname',
						'lname',
						//'user_id',
						'approval_status',				
				
				),
		));
?>

</div>
	<?php } else if ($persCount > 1) echo 'Too many entries';?>
<!-- PERSONAL MENTOR SECTION END -->


<!-- PROJECT MENTOR SECTION (ROUTE TO CONTROLLER) -->
<?php 	$projCount = Yii::app()->db->createCommand()->select('COUNT(*)')->
												from('application_project_mentor')->
												where('status="Admin"')->
         										andWhere('user_id=:id', array(':id'=>$user_id))->
												queryScalar();

		if ($projCount == 1) {?>
<div class='well project-form' style="display:none">
<h3><?php echo CHtml::link('Project Application','#',array('class'=>'project-button')); ?></h3>
</div>

<div class='well project-form' style="display:">
<h3><?php echo CHtml::link('Project Application','#',array('class'=>'project-button')); ?></h3>
<hr>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$projectMentor,
	'attributes'=>array(
		'id',
		'user_id',
		'status',
		'date_created',
		'max_amount',
		'max_hours',
		'system_pick_amount',
	),
)); ?>

<hr>
<h4>Awaiting Approval</h4>
<?php 
		$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'project_changes',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $projectMentorChanges,
		'columns'=>array(
						'id',
						'app_id',
						'project_id',
						'title',
						'approval_status',
				array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{accept} {reject}',
						'header'=>'Options',
						'buttons'=>array
						(
								'accept' => array
								(
										'label'=>'Accept',
										//'icon'=>'ok',
										'url'=>'',
										'options'=>array(
												'class'=>'btn btn-small btn-success',
										),
								),
								'reject' => array
								(
										'label'=>'Reject',
										//'icon'=>'list white',
										'url'=>'',
										'options'=>array(
												'class'=>'btn btn-small btn-danger',
										),
								),
						),
						'htmlOptions'=>array(
								'style'=>'width: 140px',
						),
				)
				),
		));
?>
<hr>
<h4>History</h4>
<?php 
		$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'project_history',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $projectMentorHistory,
		'columns'=>array(
						'id',
						'app_id',
						'project_id',
						'title',
						'approval_status',				
				
				),
		));
?>
</div>
	<?php } else if ($projCount > 1) echo 'Too many entries';?>

<!-- PROJECT MENTOR SECTION END -->


<!-- DOMAIN MENTOR SECTION (ROUTE TO CONTROLLER) -->
<?php 	$domCount = Yii::app()->db->createCommand()->select('COUNT(*)')->
												from('application_domain_mentor')->
												where('status="Admin"')->
         										andWhere('user_id=:id', array(':id'=>$user_id))->
												queryScalar();

		if ($domCount == 1) {?>
<div class='well domain-form' style="display:none">
<h3><?php echo CHtml::link('Domain Application','#',array('class'=>'domain-button')); ?></h3>
</div>

<div class='well domain-form' style="display:">
<h3><?php echo CHtml::link('Domain Application','#',array('class'=>'domain-button')); ?></h3>
<hr>	
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$domainMentor,
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
	    'id' => 'domain_changes',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $domainChanges,
		'columns'=>array(
						'id',
						'app_id',
						'proficiency',
						'domain_id',
						'approval_status',
				array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{accept} {reject}',
						'header'=>'Options',
						'buttons'=>array
						(
								'accept' => array
								(
										'label'=>'Accept',
										//'icon'=>'ok',
										'url'=>'',
										'options'=>array(
												'class'=>'btn btn-small btn-success',
										),
								),
								'reject' => array
								(
										'label'=>'Reject',
										//'icon'=>'list white',
										'url'=>'',
										'options'=>array(
												'class'=>'btn btn-small btn-danger',
										),
								),
						),
						'htmlOptions'=>array(
								'style'=>'width: 140px',
						),
				)
			),
)); 
?>
<hr>
<h5>History</h5>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'domain_history',
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
	    'id' => 'subdomain_picks',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $subdomainChanges,
		'columns'=>array(
						'id',
						'app_id',
						'proficiency',
						'subdomain_id',
						'approval_status',
				array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=>'{accept} {reject}',
						'header'=>'Options',
						'buttons'=>array
						(
								'accept' => array
								(
										'label'=>'Accept',
										//'icon'=>'ok',
										'url'=>'',
										'options'=>array(
												'class'=>'btn btn-small btn-success',
										),
								),
								'reject' => array
								(
										'label'=>'Reject',
										//'icon'=>'list white',
										'url'=>'',
										'options'=>array(
												'class'=>'btn btn-small btn-danger',
										),
								),
						),
						'htmlOptions'=>array(
								'style'=>'width: 140px',
						),
				)
						
			),
)); 
?>
<h5>History</h5>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'subdomain_history',
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
</div>
	<?php } else if ($domCount > 1) echo 'Too many entries';?>

<!-- DOMAIN MENTOR SECTION END -->