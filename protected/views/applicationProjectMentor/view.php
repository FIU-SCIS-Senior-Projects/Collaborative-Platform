<?php
/* @var $this ApplicationProjectMentorController */
/* @var $model ApplicationProjectMentor */
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
		'system_pick_amount',
	),
)); ?>

<hr>
<h4>Awaiting Approval</h4>
<?php 
		$this->widget('bootstrap.widgets.TbGridView', array(
	    //'id' => 'personal_picks',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $model3,
		'columns'=>array(
						'id',
						'app_id',
						'project_id',
						'title',
						array(
								'class' => 'editable.EditableColumn',
								'name' => 'approval_status',
								'header'=> 'Approval Status',
								//'headerHtmlOptions' => array('style' => 'width: 110px'),
								'editable' => array(    //editable section
										'type'     => 'select',
										//'mode'=>'popup',
										//'apply'      => '$data->approval_status != "Rejected"', //can't edit deleted users
										'url'        => $this->createUrl('applicationProjectMentor/updatePick'),
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
<h4>History</h4>
<?php 
		$this->widget('bootstrap.widgets.TbGridView', array(
	    //'id' => 'personal_picks',
		'summaryText'=>'',
	    //'itemsCssClass' => 'table-bordered items',
	    'dataProvider' => $model2,
		'columns'=>array(
						'id',
						'app_id',
						'project_id',
						'title',
						'approval_status',				
				
				),
		));
?>