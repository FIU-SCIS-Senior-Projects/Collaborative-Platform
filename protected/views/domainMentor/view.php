<?php
/* @var $this DomainMentorController */
/* @var $model DomainMentor */

$this->breadcrumbs=array(
	'Domain Mentors'=>array('index'),
	$model->user_role_user_id,
);

$this->menu=array(
	array('label'=>'List DomainMentor', 'url'=>array('index')),
	array('label'=>'Create DomainMentor', 'url'=>array('create')),
	array('label'=>'Update DomainMentor', 'url'=>array('update', 'id'=>$model->user_role_user_id)),
	array('label'=>'Delete DomainMentor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_role_user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DomainMentor', 'url'=>array('admin')),
);
?>

<h1>View DomainMentor #<?php echo $model->user_role_user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_role_user_id',
		'user_role_role_id',
		'max_tickets',
	),
)); ?>
