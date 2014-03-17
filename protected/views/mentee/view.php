<?php
/* @var $this MenteeController */
/* @var $model Mentee */

$this->breadcrumbs=array(
	'Mentees'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List Mentee', 'url'=>array('index')),
	array('label'=>'Create Mentee', 'url'=>array('create')),
	array('label'=>'Update Mentee', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete Mentee', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mentee', 'url'=>array('admin')),
);
?>

<h1>View Mentee #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'projectmentor_project_project_id',
		'projectmentor_project_project_mentor_user_id',
	),
)); ?>
