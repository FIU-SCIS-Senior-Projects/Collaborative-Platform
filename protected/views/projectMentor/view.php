<?php
/* @var $this ProjectMentorController */
/* @var $model ProjectMentor */

$this->breadcrumbs=array(
	'Project Mentors'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List ProjectMentor', 'url'=>array('index')),
	array('label'=>'Create ProjectMentor', 'url'=>array('create')),
	array('label'=>'Update ProjectMentor', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete ProjectMentor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectMentor', 'url'=>array('admin')),
);
?>

<h1>View ProjectMentor #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'max_hours',
		'max_projects',
	),
)); ?>
