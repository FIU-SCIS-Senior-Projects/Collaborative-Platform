<?php
/* @var $this PersonalMeetingController */
/* @var $model PersonalMeeting */

$this->breadcrumbs=array(
	'Personal Meetings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PersonalMeeting', 'url'=>array('index')),
	array('label'=>'Create PersonalMeeting', 'url'=>array('create')),
	array('label'=>'Update PersonalMeeting', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PersonalMeeting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PersonalMeeting', 'url'=>array('admin')),
);
?>

<h1>View PersonalMeeting #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mentee_user_id',
		'personal_mentor_user_id',
		'date',
	),
)); ?>
