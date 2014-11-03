<?php
/* @var $this UserController */
/* @var $model Project */
?>

<!-- PROJECT DETAILS START-->
<div class='well'>
<h3>Project Details</h3>
<hr>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
					'label'=>'Title',
					'type'=>'raw',
					'value'=>CHtml::encode($model->title),
			),
			array(
						'label'=>'Customer',
						'type'=>'raw',
						'value'=> CHtml::encode($model->customer_fname . ' ' . $model->customer_lname ),
			),
				array(
						'label'=>'Proposed By',
						'type'=>'raw',
						'value'=> CHtml::encode($model->proposeByUser->fname . ' ' . $model->proposeByUser->lname ),
				),
			array(
						'label'=>'Project Mentor',
						'type'=>'raw',
						'value'=> CHtml::encode($model->getProjectMentor()),
				),
			array(
						'label'=>'Start Date',
						'type'=>'raw',
						'value'=> CHtml::encode(date("M d, Y", strtotime($model->start_date))),
				),
			array(
						'label'=>'Due Date',
						'type'=>'raw',
						'value'=> CHtml::encode(date("M d, Y", strtotime($model->due_date))),
				),
			array(
						'label'=>'Description',
						'type'=>'raw',
						'value'=> CHtml::encode($model->description),
				),
		),
)); 
?>
</div>
<!-- PROJECT DETAILS END -->

<!-- MENTEES START -->
<div class='well'>
<h3>Mentees</h3>
<?php 				
                                        
                    $this->widget('bootstrap.widgets.TbGridView', array(
                    		'type'=>'striped condensed hover',
                    		'id'=>'id',
							'dataProvider'=>  new CArrayDataProvider($model->mentees, array('keyField'=>'user_id')),
                    		'summaryText'=>'',
                    		//'filter'=>$model,
                    		'columns'=>array(
                    				array(
                    						'name'=>'user.fname',
        									'value'=>'$data->user->fname . " " . $data->user->lname',
                    						'header'=>'',
                    						                    ),
                    		),
                    ));
?>
</div>
<!-- MENTEES END -->



<!-- TICKETS -->
<div class='well'>
<h3>Tickets</h3>
<?php 
	$thisID = $model->id;
	$rawData = new CSqlDataProvider
	('SELECT id, subject, assigned_date, status FROM mentee m, ticket t WHERE m.user_id = t.creator_user_id AND m.project_id ='.$thisID.'');

	$this->widget('bootstrap.widgets.TbGridView', array(
			'type'=>'striped condensed hover',
			'id'=>'id',
			'dataProvider'=>  $rawData,
			'summaryText'=>'',
			//'filter'=>$model,
			'columns'=>array(
						array(
							'name'=>'id',
							'value'=>'$data["id"]',
							'header'=>'ID',
						),array(
							'name'=>'subject',
							'value'=>'$data["subject"]',
							'header'=>'Subject',
						),array(
							'name'=>'assigned_date',
							'value'=>'$data["assigned_date"]',
							'header'=>'Assigned Date',
						),array(
							'name'=>'status',
							'value'=>'$data["status"]',
							'header'=>'Status',
						),array(
						'header'=>'Options',
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=> '{view}',
						'buttons'=>array(
								'view'=>
								array(
										'url'=>'Yii::app()->createUrl("ticket/view", array("id"=>$data["id"]))',
											
								),
						),
				),
 ),
));
?>
</div>
<!-- TICKETS END -->


<!-- MEETINGS -->
<div class='well'>
<h3>Meetings</h3>
<?php 

		$thisID = $model->id;
		$rawData = new CSqlDataProvider
			('select DISTINCT t1.id, t1.date, t1.time, mentorfullname, menteefullname FROM 
					(SELECT pm.id, date, time, concat(u.fname, " ", u.lname) as mentorfullname FROM user u, project_meeting pm, mentee m WHERE u.id = pm.project_mentor_user_id AND m.project_id ='.$thisID.') t1, 
					(SELECT pm.id, date, time, concat(u.fname, " ", u.lname) as menteefullname FROM user u, project_meeting pm, mentee m WHERE u.id = pm.mentee_user_id AND m.project_id ='.$thisID.') t2 
			WHERE t1.id = t2.id');

		$this->widget('bootstrap.widgets.TbGridView', array(
				'type'=>'striped condensed hover',
				'id'=>'id',
				'dataProvider'=>  $rawData,
				'summaryText'=>'',
				//'filter'=>$model,
				'columns'=>array(
							array(
									'name'=>'id',
									'value'=>'$data["id"]',
									'header'=>'ID',
							),  
							array(
									'name'=>'date',
									'value'=>'$data["date"]',
									'header'=>'Date',
							),  				
							array(
									'name'=>'time',
									'value'=>'$data["time"]',
									'header'=>'Time',
							),  				
							array(
									'name'=>'menteefullname',
									'value'=>'$data["menteefullname"]',
									'header'=>'Mentee Name',
							), 
							array(
									'name'=>'mentorfullname',
									'value'=>'$data["mentorfullname"]',
									'header'=>'Mentor name',
							),
				/* array(
						'header'=>'Options',
						'class'=>'bootstrap.widgets.TbButtonColumn',
						'template'=> '{view}',
						'buttons'=>array(
								'view'=>
								array(
										'url'=>'Yii::app()->createUrl("meeting/view", array("id"=>$data["id"]))',
											
								),
						),
				), */
 ),
));
?>
</div>
<!-- MEETINGS END -->
