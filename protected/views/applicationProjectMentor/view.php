<?php
/* @var $this ApplicationProjectMentorController */
/* @var $model ApplicationProjectMentor */
?>

<h3>View ApplicationProjectMentor #<?php echo $model->id; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
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
