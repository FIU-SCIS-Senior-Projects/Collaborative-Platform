<?php
/* @var $this ApplicationPersonalMentorController */
/* @var $model ApplicationPersonalMentor */
?>

<h3>View ApplicationPersonalMentor #<?php echo $model->id; ?></h3>

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
		'university_id',
	),
)); ?>
