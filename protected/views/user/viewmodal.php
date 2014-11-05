<?php
/* @var $this UserController */
/* @var $model User */
/* @var $udmodel User */
/* @var $Mentees Mentee */
/* @var $UserDomain UserDomain */

Yii::app()->clientScript->registerScript('modal', "
$('.mentee-button').click(function(){
	$('.mentee-form').toggle();
	return false;
});
		
		$('.mentor-button').click(function(){
	$('.mentor-form').toggle();
	return false;
});

$('.project-button').click(function(){
	$('.project-form').toggle();
	return false;
});
		
$('.personal-button').click(function(){
	$('.personal-form').toggle();
	return false;
});

$('.domain-button').click(function(){
	$('.domain-form').toggle();
	return false;
});
		
$('.tickets-button').click(function(){
	$('.tickets-form').toggle();
	return false;
});
		
$('.meetings-button').click(function(){
$('.meetings-form').toggle();
return false;
		
});	

");
?>

<div class='well'>
<table>
  <tr>
    <th><?php echo CHtml::image($model->pic_url, $model->fname, array('style'=>'width:80px; height:80px;')); ?></th>
    <th><h2><?php echo $model->fname . ' ' . $model->lname?></h2></th>
  </tr>
</table>	 
	</div> 
<div>

	
	<?php $this->widget('editable.EditableDetailView', array(
    	'data'       => $model,				
    //you can define any default params for child EditableFields 
    	'url'        => $this->createUrl('user/updateUser'), //common submit url for all fields
    	'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
    	'emptytext'  => 'no value',
      
    'attributes' => array(
//         array(
//             'name' => 'fname',        		
//             'editable' => array(
//                 'type'       => 'text',
//                 'inputclass' => 'input-large',
//                 'validate'   => 'function(value) {
//                     if(!value) return "First Name is required"
//                 }'
//             )
//         ),
//         array( //select loaded from database
//             'name' => 'mname',
//             'editable' => array(
//                 'type'       => 'text',
//                 'inputclass' => 'input-large',
//                 //'validate'   => 'function(value) {
//                 //    if(!value) return "User Name is required"
//                 //}'
//             )
//         ),
//         array( //select loaded from ajax.
//             'name' => 'lname',
//            	'editable' => array(
//                 'type'       => 'text',
//                 'inputclass' => 'input-large',
//                 'emptytext'  => 'special emptytext',                
//                 //'validate'   => 'function(value) {
//                 //    if(!value) return "User Name is required"
//                 //}'
//             )
//         ),
		array(
				'name' =>'biography',
				'editable' => array(
					'type' => 'textarea',
				)
	),    		
    		array( //select loaded from ajax.
    				'name' => 'disable',
    				'editable' => array(
    						'type'       => 'select',
    						'inputclass' => 'input-small',
    						'source'    => Editable::source(array(0 => 'No', 1 => 'Yes')),
    				)
    		),
    )
    ));
	?>		
    			
</div>

	<!--  MENTEE START -->
	<?php if($model->isMentee) {?>
	<div class='well mentor-form' style="display:">	
	
	<h3><?php echo CHtml::link('Mentee','#',array('class'=>'mentor-button')); ?></h3>
	<hr>

	<?php $this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>array(
				array(
						'label'=>'Project',
						'type'=>'raw',
						'value'=> CHtml::value($model, 'mentee.project.title'),
				),
				array(
						'label'=>'Personal Mentor',
						'type'=>'raw',
						'value'=> CHtml::value($model, 'mentee.personalMentorUser.user.fname') . " " . CHtml::value($model, 'mentee.personalMentorUser.user.lname'),
				),
				
		),
)); 
?>
</div>
<?php }?>
<!--  MENTEE END -->
	
	
	
<!-- PROJECT MENTOR START -->
<?php if($model->isProMentor) {?>
<div class='well project-form' style="display:">

<h3><?php echo CHtml::link('Project Mentor','#',array('class'=>'project-button')); ?></h3>
<hr>
<?php 
				$maxProjectHours = Yii::app()->db->createCommand()->
												select('max_hours')->
												from('project_mentor')->
         										where('user_id=:id', array(':id'=>$model->id))->
												queryScalar();

	$maxProjects = Yii::app()->db->createCommand()->select('max_projects')->
	from('project_mentor')->
	where('user_id=:id', array(':id'=>$model->id))->queryScalar();
				
	if ($maxProjectHours === null || $maxProjectHours === false|| $maxProjectHours === '') $maxProjectHours = 'Not Set';
	if (is_null($maxProjects) || $maxProjects === false|| $maxProjects === '') $maxProjects = 'Not Set';
								
 	echo 'Maximum Hours: ' . $maxProjectHours;?><br/><?php 
 	echo 'Maximum Projects: ' . $maxProjects;
			 
	    
	    
	    			$thisID = $model->id;
                    $rawData = new CSqlDataProvider('SELECT id, title FROM project WHERE project_mentor_user_id = '.$thisID.'');
                   
                                        
                    $this->widget('bootstrap.widgets.TbGridView', array(
                    		'type'=>'striped condensed hover',
                    		'id'=>'id',
                    		'dataProvider'=>$rawData,
                    		'summaryText'=>'',
                    		//'filter'=>$model,
                    		'columns'=>array(
                    				array(
                    						'name'=>'',
											'value'=>'$data["title"]',                    						
                    )
                    				
                    		),
                    )); ?>
</div>
<?php }?>
	
<!-- PERSONAL MENTOR START -->
<?php if($model->isPerMentor) {?>
<div class='well personal-form' style="display:">

<h3><?php echo CHtml::link('Personal Mentor','#',array('class'=>'personal-button')); ?></h3>
<hr>
	<?php
	
	$maxMenteeHours = Yii::app()->db->createCommand()->
								select('max_hours')->
								from('personal_mentor')->
								where('user_id=:id', array(':id'=>$model->id))->
								queryScalar();
	
	$maxMentees = Yii::app()->db->createCommand()->
								select('max_mentees')->
								from('personal_mentor')->
								where('user_id=:id', array(':id'=>$model->id))->
								queryScalar();

	if ($maxMenteeHours === null || $maxMenteeHours === false || $maxMenteeHours === '') 
			$maxMenteeHours = 'Not Set';
	if ($maxMentees === null || $maxMentees === false || $maxMentees === '')
			$maxMentees = 'Not Set';
		
	echo 'Maximum Hours: ' . $maxMenteeHours;?><br/><?php
	echo 'Maximum Mentees: ' . $maxMentees;
	
	$thisID = $model->id;
    $rawData = new CSqlDataProvider
    		('SELECT id, concat(fname, " ", lname) as fullname FROM user u, mentee m WHERE u.id = m.user_id AND m.personal_mentor_user_id ='.$thisID.'');
    
            $this->widget('bootstrap.widgets.TbGridView', array(
            	'type'=>'striped condensed hover',
                'id'=>'id',
                'dataProvider'=>  $rawData,
                'summaryText'=>'',
                //'filter'=>$model,
                'columns'=>array(
								array(
									'name'=>'fullname',
									'value'=>'$data["fullname"]',
									'header'=>'Name',
								),          
            				),
             	)); 
	?>
	
	
</div>
<?php }?>
<!-- PERSONAL MENTOR END -->
	
	
<!-- DOMAIN MENTOR START -->
<?php if($model->isDomMentor) {?>	
<div class='well domain-form' style="display:">	

<h3><?php echo CHtml::link('Domain Mentor','#',array('class'=>'domain-button')); ?></h3>
<hr>
<?php
	$maxTickets = Yii::app()->db->createCommand()->select('max_tickets')->
	from('domain_mentor')->
	where('user_id=:id', array(':id'=>$model->id))->queryScalar();
	
	if ($maxTickets === null || $maxTickets === false) $maxTickets = 'Not Set';
		
	echo 'Maximum Tickets: ' . $maxTickets;
?>
<br/>
<?php 
	$ratings = array(1,2,3,4,5,6,7,8,9,10);
	
	$this->widget('bootstrap.widgets.TbGridView', array(
			'type'=>'striped condensed hover',
			'id'=>'id',
			'dataProvider'=>  new CArrayDataProvider($model->userDomains, array('keyField'=>'id')),
			'summaryText'=>'',
			//'filter'=>$model,
			'columns'=>array(
					array(
							'name'=>'id',
							'value'=>'$data->id',
							'header'=>'ID',
					),
					array(
							'name'=>'domain.name',
							'value'=>'$data->domain->name',
							'header'=>'Domain',
					),
					array(
							'name'=>'subdomain.name',
							'value'=>'$data->subdomain->name',
							'header'=>'Sub-Domain',
					),
					array(
							'class' => 'editable.EditableColumn',
							'name' => 'rate',
							'header'=>'Rate',
							'editable' => array(
									'type'      => 'select',
									'url'       => $this->createUrl('userdomain/updateUser'),
									'source'    => Editable::source($ratings),
									'inputclass' => 'input-mini',
									'placement' => 'left',
							)
					),
					array( 
            				'class' => 'editable.EditableColumn',
            				'name' => 'tier_team',
							'header'=>'Tier',
            				'editable' => array(
               				 			'type'      => 'select',
              				  			'url'       => $this->createUrl('userdomain/updateUser'),
		            					'source'    => Editable::source(array(1 => '1', 2 => '2')),
						            	'inputclass' => 'input-mini',	
						                'placement' => 'left',
            							)
          				),  		
					),
	));?>
</div>	
<?php }?>
<!-- DOMAIN MENTOR END -->



<!-- TICKETS START -->
<div class='well tickets-form' style="display:">

	<h3><?php echo CHtml::link('Tickets','#',array('class'=>'tickets-button')); ?></h3>
	<hr>
	<?php	 
	$this->widget('bootstrap.widgets.TbGridView', array(
			'type'=>'striped condensed hover',
			'id'=>'id',
			'dataProvider'=>  new CArrayDataProvider($model->tickets + $model->tickets1, array('keyField'=>false)),
						'summaryText'=>'',
			//'selectableRows'=>1,
			//'selectionChanged'=>"function(id){window.location='" .  Yii::app()->urlManager->createUrl('servers/view', array('id'=>$model->id)) . "' + $.fn.yiiGridView.getSelection(id);}",
				
			//'filter'=>$model,
			'columns'=>array(
							array(
                    						'name'=>'id',
        									'value'=>'$data->id',
                    						'header'=>'ID',
							),
							array(
                    						'name'=>'subject',
        									'value'=>'$data->subject',
                    						'header'=>'Subject',
                    		),
							array(
                    						'name'=>'assigned_date',
        									'value'=>'$data->assigned_date',
                    						'header'=>'Mentees',
                    		),
							array(
                    						'name'=>'status',
        									'value'=>'$data->status',
                    						'header'=>'Status',
                    		),
							array(
									'header'=>'Options',
									'class'=>'bootstrap.widgets.TbButtonColumn',
									'template'=> '{view}',
									'buttons'=>array(
											'view'=>
											array(
													'url'=>'Yii::app()->createUrl("ticket/view", array("id"=>$data->id))',
													
											),
									),
							),
			),
	));
	?>
</div>
<!-- TICKETS END -->

<!-- MEETINGS START -->
<?php if($model->isProMentor || $model->isPerMentor || $model->isMentee) {?>	
<div class='well meetings-form' style="display:">

	<h3><?php echo CHtml::link('Meetings','#',array('class'=>'meetings-button')); ?></h3>
	<hr>
	<?php	 
	
	
	if ($model->isProMentor) {
	?><h4>Project Meetings</h4><?php
	$this->widget('bootstrap.widgets.TbGridView', array(
			'type'=>'striped condensed hover',
			'id'=>'id',
			'dataProvider'=>  new CArrayDataProvider($model->projectMentor->projectMeetings, array('keyField'=>false)),
						'summaryText'=>'',
			'columns'=>array(
							array(
									'name'=>'id',
									'value'=>'$data->id',
									'header'=>'ID',
							),  
							array(
									'name'=>'date',
									'value'=>'$data->date',
									'header'=>'Date',
							),  				
							array(
									'name'=>'time',
									'value'=>'$data->time',
									'header'=>'Time',
							),  				
							array(
									'name'=>'menteeUser.user.fname',										
									'value'=>'$data->menteeUser->user->fname . " " . $data->menteeUser->user->lname',
									'header'=>'Mentee Name',
							),
			),
	));
	}
	if ($model->isPerMentor) {
		?><hr><h4>Personal Meetings</h4><?php
		$this->widget('bootstrap.widgets.TbGridView', array(
				'type'=>'striped condensed hover',
				'id'=>'id',
				'dataProvider'=>  new CArrayDataProvider($model->personalMentor->personalMeetings, array('keyField'=>false)),
				'summaryText'=>'',
				'columns'=>array(
						array(
								'name'=>'id',
								'value'=>'$data->id',
								'header'=>'ID',
						),
						array(
								'name'=>'date',
								'value'=>'$data->date',
								'header'=>'Date',
						),
						array(
								'name'=>'time',
								'value'=>'$data->time',
								'header'=>'Time',
						),
						array(
								'name'=>'menteefullname',
								'value'=>'$data->menteeUser->user->fname . " " . $data->menteeUser->user->lname',
								'header'=>'Mentee Name',
						),
				),
		));
	}
	
	$exists = Chtml::value($model, 'mentee');
	
	if ($model->isMentee && $exists !== null) {
		?><h4>Personal Mentor Meetings</h4><?php
				$this->widget('bootstrap.widgets.TbGridView', array(
						'type'=>'striped condensed hover',
						'id'=>'id',
						'dataProvider'=>  new CArrayDataProvider($model->mentee->personalMeetings, array('keyField'=>false)),
						'summaryText'=>'',
						'columns'=>array(
								array(
										'name'=>'id',
										'value'=>'$data->id',
										'header'=>'ID',
								),
								array(
										'name'=>'date',
										'value'=>'$data->date',
										'header'=>'Date',
								),
								array(
										'name'=>'time',
										'value'=>'$data->time',
										'header'=>'Time',
								),
								array(
										'name'=>'permentorfullname',
										'value'=>'$data->personalMentorUser->user->fname . " " . $data->personalMentorUser->user->lname',
										'header'=>'Personal Mentor Name',
								),
						),
				));
			
			?><h4>Project Mentor Meetings</h4><?php
							$this->widget('bootstrap.widgets.TbGridView', array(
									'type'=>'striped condensed hover',
									'id'=>'id',
									'dataProvider'=>  new CArrayDataProvider($model->mentee->projectMeetings, array('keyField'=>false)),
									'summaryText'=>'',
									'columns'=>array(
											array(
													'name'=>'id',
													'value'=>'$data->id',
													'header'=>'ID',
											),
											array(
													'name'=>'date',
													'value'=>'$data->date',
													'header'=>'Date',
											),
											array(
													'name'=>'time',
													'value'=>'$data->time',
													'header'=>'Time',
											),
											array(
													'name'=>'projmentorfullname',
													'value'=>'$data->projectMentorUser->user->fname . " " . $data->projectMentorUser->user->lname',
													'header'=>'Project Mentor Name',
											),
									),
							));
	} else echo 'No meetings'
	?>
</div>
<?php }?>
<!-- MEETINGS END -->

