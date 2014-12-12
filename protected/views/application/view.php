<?php
/* @var $this ApplicationController */
/* @var $user_id UserID */

$this->breadcrumbs=array(
	'Applications'=>array('admin'),
	$user_id,
);

$myVarList = array(
		'myCount'=>$newCount,
);

$json = CJSON::encode($myVarList);

Yii::app()->clientScript->registerScript('application', "

var myCount = " . $newCount . ";
var count = 0;
		
		
$('.personal-button').click(function(){
	$('.personal-form').toggle();
	$('.personal-button').toggle();
	return false;
});

$('.project-button').click(function(){
	$('.project-form').toggle();
	$('.project-button').toggle();
	return false;
});

$('.domain-button').click(function(){
	$('.domain-form').toggle();
	$('.domain-button').toggle();
	return false;
});	
		
$('#personal_changes .btn-success').click(function(){
		personalChangesApprove($(this));
	});
		
$('#personal_changes .btn-danger').click(function(){
		personalChangesReject($(this));
	});
		
$('#project_changes .btn-success').click(function(){
		projectChangesApprove($(this));
	});
				
$('#project_changes .btn-danger').click(function(){
		projectChangesReject($(this));
	});
		
$('#domain_changes .btn-success').click(function(){
		domainChangesApprove($(this));
	});

$('#domain_changes .btn-danger').click(function(){
		domainChangesReject($(this));
	});
		
$('#subdomain_changes .btn-success').click(function(){
		subDomainChangesApprove($(this));
	});

$('#subdomain_changes .btn-danger').click(function(){
		subDomainChangesReject($(this));
	});
		
		function submitCheck(obj) {
			if (count == myCount) {
				var submit = $('#submitmain');
				submit.removeAttr('disabled');
					console.log('i enabled you!');
		
			}
			console.log(count + '/' + myCount);
		}
		
		function setButtonStatus(parent, child, parenthiddenfield, childhiddenfield) {
			
			var value = '';
			value = parent.parent().parent().children('td:first').text();
			console.log(value);
		
			if(parent.attr('disabled')){
				// do nothing when disabled
  			}else{
				if(child.attr('disabled')){
					child.removeAttr('disabled');
					parent.attr('disabled', 'true');
		
					
					removeId(value, childhiddenfield);
					addId(value, parenthiddenfield);
  				}else{
					parent.attr('disabled', 'true');
					count++;
					submitCheck(parent);
		
					addId(value, parenthiddenfield);
				 }
				}
	}
		
		function addId(currentvalue, hiddenfield){
			var currentIds = $(hiddenfield).val();
			var separator = (currentIds === '') ? '' : ',';
			$(hiddenfield).val(currentIds + separator + currentvalue);
		}
		
		function removeId(currentvalue, hiddenfield){
			var currentIds = $(hiddenfield).val().split(',');
			for(var i = 0; i < currentIds.length; i++){
			 	if(currentIds[i] === currentvalue){
					currentIds.splice(i, 1);
				}
			}
			var result = currentIds.join(',');
			console.log(result);
			$(hiddenfield).val(result);
		}
		
		function personalChangesApprove(obj) {		
			var child = obj.parent('td').children('#personal_changes_reject');
			setButtonStatus(obj, child, '#personalhiddeninputaccept', '#personalhiddeninputreject');	
		}	
		
		function personalChangesReject(obj) {
			var child = obj.parent('td').children('#personal_changes_accept');	
			setButtonStatus(obj, child, '#personalhiddeninputreject', '#personalhiddeninputaccept');	
				}
		
		function projectChangesApprove(obj) {			
			var child = obj.parent('td').children('#project_changes_reject');
			setButtonStatus(obj,child, '#projecthiddeninputaccept', '#projecthiddeninputreject');
		}	
		
		function projectChangesReject(obj) {
			var child = obj.parent('td').children('#project_changes_accept');
			setButtonStatus(obj,child, '#projecthiddeninputreject', '#projecthiddeninputaccept');
				}
		
		function domainChangesApprove(obj) {
			var child = obj.parent('td').children('#domain_changes_reject');
			setButtonStatus(obj,child, '#domainhiddeninputaccept', '#domainhiddeninputreject');
				}	
		
		function domainChangesReject(obj) {
			var child = obj.parent('td').children('#domain_changes_accept');
			setButtonStatus(obj,child, '#domainhiddeninputreject', '#domainhiddeninputaccept');
				}	
		
		function subDomainChangesApprove(obj) {
			var child = obj.parent('td').children('#subdomain_changes_reject');
			setButtonStatus(obj,child, '#subdomainhiddeninputaccept', '#subdomainhiddeninputreject');
				}	
		
		function subDomainChangesReject(obj) {
			var child = obj.parent('td').children('#subdomain_changes_accept');
			setButtonStatus(obj,child, '#subdomainhiddeninputreject', '#subdomainhiddeninputaccept');
				}		

// 		$('#personal_propose').click(function(){
// 			$('.personal-form').toggle();
// 			$('#personal-button').toggle();
// 			return false;
// 		});
		
// 		$('.personal-form submit').click(function(){
// 			$('.personal-form').toggle();
// 			$('#personal-button').toggle();
// 			return false;
// 		});
		
");

// $('#personal_history').on('mouseover mouseout', 'table tr', function(event) {
// 	if (event.type == 'mouseover') {
// 		$('.project-form').toggle();

// 	} else if (event.type == 'mouseout') {
// 		$('.project-form').toggle();

// 	}
// });

?>

<?php if (!is_null($userInfo)){
	$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$userInfo,
	'attributes'=>array(
			'user.fname',
			'user.lname',
		'employer',
			'position',
			'job_start',
			'degree',
			'field_of_study',
			'university',
			'grad_year',
			
	),
)); 
}?>


<!-- PERSONAL MENTOR SECTION (ROUTE TO CONTROLLER) -->

<?php 	$persCount = Yii::app()->db->createCommand()->select('COUNT(*)')->
												from('application_personal_mentor')->
												where('status="Admin"')->
         										andWhere('user_id=:id', array(':id'=>$user_id))->
												queryScalar();

		if ($persCount == 1) {?>		

<div class='well personal-form' style="display:">
<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'default',
				'icon'=>'plus',
				'size'=>'large',
                'label'=>'Personal Mentor Application',
				'htmlOptions'=>array(
						'class'=>'personal-button',
						'style'=>'display:'
						),
)); ?>
</div>

<div class='well personal-form' style="display:none">
<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'default',
				'icon'=>'minus',
				'size'=>'large',
                'label'=>'Personal Mentor Application',
				'htmlOptions'=>array(
						'class'=>'personal-button',
						'style'=>'display:none'
						),
)); ?><br/><br/>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$personalMentor,
	'attributes'=>array(
		//'id',
		//'user_id',
		//'status',
		'date_created',
		'max_amount',
		'max_hours',
		'system_pick_amount',
		'university.name',
	),
)); ?>
<hr>
<h4>Awaiting Approval</h4>
<?php 
		$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'personal_changes',
		'type'=>'striped condensed hover',	
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $personalMentorChanges,
		'columns'=>array(
						'id',
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
												'id'=>'personal_changes_accept',
												'class'=>'btn btn-small btn-success',
										),
								),
								'reject' => array
								(
										'label'=>'Reject',
										//'icon'=>'list white',
										'url'=>'',
										'options'=>array(
												'id'=>'personal_changes_reject',
												'class'=>'btn btn-small btn-danger',
										),
								),
						),
						'htmlOptions'=>array(
								'style'=>'width: 120px',
						),
				)
				
				),
		));
?>



<hr>
<h4>History</h4>
<?php 
		$this->widget('bootstrap.widgets.TbGridView', array(
		'type'=>'striped condensed hover',	
	    'id' => 'personal_history',
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $personalMentorHistory,
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
?>

<?php $this->renderPartial('app_personalpick_form', array('model'=>$perModel))?>


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
		

<div class='well project-form' style="display:">
<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'default',
				'icon'=>'plus',
				'size'=>'large',
                'label'=>'Project Mentor Application',
				'htmlOptions'=>array(
						'class'=>'project-button',
						'style'=>'display:'
						),
)); ?>
</div>

<div class='well project-form' style="display:none">
<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'default',
				'icon'=>'minus',
				'size'=>'large',
                'label'=>'Project Mentor Application',
				'htmlOptions'=>array(
						'class'=>'project-button',
						'style'=>'display:none'
						),
)); ?><br/><br/>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$projectMentor,
	'attributes'=>array(
		//'id',
		//'user_id',
		//'status',
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
				'type'=>'striped condensed hover',
				
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $projectMentorChanges,
		'columns'=>array(
						'id',
						//'app_id',
						//'project_id',
						array(
							'value'=>'$data["title"]',
							'header'=>'Project Title',	
						),array(
							'value'=>'$data["approval_status"]',
							'header'=>'Approval Status',	
						),
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
												'id'=>'project_changes_accept',
												'class'=>'btn btn-small btn-success',
										),
								),
								'reject' => array
								(
										'label'=>'Reject',
										//'icon'=>'list white',
										'url'=>'',
										'options'=>array(
												'id'=>'project_changes_reject',
												'class'=>'btn btn-small btn-danger',
										),
								),
						),
						'htmlOptions'=>array(
								'style'=>'width: 120px',
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
		'type'=>'striped condensed hover',
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $projectMentorHistory,
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
?>

<?php $this->renderPartial('app_projectpick_form', array('model'=>$proModel))?>


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
		
	
<div class='well domain-form' style="display:">
<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'default',
				'icon'=>'plus',
				'size'=>'large',
                'label'=>'Domain Mentor Application',
				'htmlOptions'=>array(
						'class'=>'domain-button',
						'style'=>'display:'
						),
)); ?>
</div>

<div class='well domain-form' style="display:none">
<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'default',
				'icon'=>'minus',
				'size'=>'large',
                'label'=>'Domain Mentor Application',
				'htmlOptions'=>array(
						'class'=>'domain-button',
						'style'=>'display:none'
						),
)); ?><br/><br/>	
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$domainMentor,
	'attributes'=>array(
		//'id',
		//'user_id',
		//'status',
		'date_created',
		'max_amount',
		'max_hours',
	),
)); ?>
<hr>
<h4>Domain Picks</h4>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'domain_changes',
		'type'=>'striped condensed hover',
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $domainChanges,
		'columns'=>array(
						//'id',
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
												'id'=>'domain_changes_accept',
												
												'class'=>'btn btn-small btn-success',
										),
								),
								'reject' => array
								(
										'label'=>'Reject',
										//'icon'=>'list white',
										'url'=>'',
										'options'=>array(
												'id'=>'domain_changes_reject',
												
												'class'=>'btn btn-small btn-danger',
										),
								),
						),
						'htmlOptions'=>array(
								'style'=>'width: 120px',
						),
				)
			),
)); 
?>

<hr>
<h5>History</h5>
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
?>

<?php $this->renderPartial('app_domainpick_form', array('model'=>$domModel))?>


<h4>Sub-Domain Picks</h4>
<?php	$this->widget('bootstrap.widgets.TbGridView', array(
	    'id' => 'subdomain_changes',
		'type'=>'striped condensed hover',
		'summaryText'=>'',
	    'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $subdomainChanges,
		'columns'=>array(
						'id',
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
										'visible'=>'true',
										'options'=>array(
												'id'=>'subdomain_changes_accept',
												
												'class'=>'btn btn-small btn-success',												
										),
										
								),
								'reject' => array
								(
										'label'=>'Reject',
										//'icon'=>'list white',
										'url'=>'',
										'options'=>array(
												'id'=>'subdomain_changes_reject',
												
												'class'=>'btn btn-small btn-danger',
										),
								),
						),
						'htmlOptions'=>array(
								'style'=>'width: 120px',
						),
				)
						
			),
)); 
?>


<hr>
<h5>History</h5>
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
?>

<?php $this->renderPartial('app_subdomainpick_form', array('model'=>$subModel))?>

</div>
	<?php } else if ($domCount > 1) echo 'Too many entries';?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'mentor_app',
	'enableAjaxValidation'=>false,
)); ?>
<!-- Hidden field for personal picks -->
<?php echo CHtml::hiddenField('personal_picks_accept', '', array('id'=>'personalhiddeninputaccept'));?>
<?php echo CHtml::hiddenField('personal_picks_reject', '', array('id'=>'personalhiddeninputreject'));?>
<!-- Hidden field for project picks -->
<?php echo CHtml::hiddenField('project_picks_accept', '', array('id'=>'projecthiddeninputaccept'));?>	
<?php echo CHtml::hiddenField('project_picks_reject', '', array('id'=>'projecthiddeninputreject'));?>	
<!-- Hidden field for domain picks -->
<?php echo CHtml::hiddenField('domain_picks_accept', '', array('id'=>'domainhiddeninputaccept'));?>
<?php echo CHtml::hiddenField('domain_picks_reject', '', array('id'=>'domainhiddeninputreject'));?>	
<?php echo CHtml::hiddenField('subdomain_picks_accept', '', array('id'=>'subdomainhiddeninputaccept'));?>
<?php echo CHtml::hiddenField('subdomain_picks_reject', '', array('id'=>'subdomainhiddeninputreject'));?>
			
<?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-large btn-primary",'id'=>'submitmain', "disabled"=>"disabled")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>

<a style="text-decoration:none" href="/coplat/index.php/application/admin">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'danger',
				'size'=>'large',
                'label'=>'Cancel',
            )); ?>
</a>
<?php $this->endWidget();?>

<!-- DOMAIN MENTOR SECTION END -->