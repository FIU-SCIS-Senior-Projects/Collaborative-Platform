<?php
/* @var $this ApplicationPersonalMentorController */
/* @var $model ApplicationPersonalMentor */
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
		'university_id',
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
						'fname',
						'lname',
						//'user_id',
						array(
								'class' => 'editable.EditableColumn',
								'name' => 'approval_status',
								'header'=> 'Approval Status',
								//'headerHtmlOptions' => array('style' => 'width: 110px'),
								'editable' => array(    //editable section
										'type'     => 'select',
										//'mode'=>'popup',
										//'apply'      => '$data->approval_status != "Rejected"', //can't edit deleted users
										'url'        => $this->createUrl('applicationPersonalMentor/updatePick'),
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
						'fname',
						'lname',
						//'user_id',
						'approval_status',				
				
				),
		));
?>