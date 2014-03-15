<?php
/* @var $this ProjectMeetingController */
/* @var $model ProjectMeeting */

$this->breadcrumbs=array(
	'Project Meetings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProjectMeeting', 'url'=>array('index')),
	array('label'=>'Create ProjectMeeting', 'url'=>array('create')),
	array('label'=>'Update ProjectMeeting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProjectMeeting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectMeeting', 'url'=>array('admin')),
);
?>

<h1>View ProjectMeeting #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_mentor_user_role_user_id',
		'mentee_user_role_user_id',
		'date',
	),
)); ?>
