<?php
/* @var $this ApplicationDomainMentorController */
/* @var $model ApplicationDomainMentor */
?>

<h3>View ApplicationDomainMentor #<?php echo $model->id; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'status',
		'date_created',
		'max_amount',
		'max_hours',
	),
)); ?>
