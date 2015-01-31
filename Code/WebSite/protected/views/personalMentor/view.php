<?php
/* @var $this PersonalMentorController */
/* @var $model PersonalMentor */

$this->breadcrumbs=array(
	'Personal Mentors'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List PersonalMentor', 'url'=>array('index')),
	array('label'=>'Create PersonalMentor', 'url'=>array('create')),
	array('label'=>'Update PersonalMentor', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete PersonalMentor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PersonalMentor', 'url'=>array('admin')),
);
?>

<h1>View PersonalMentor #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'max_hours',
		'max_mentees',
	),
)); ?>
