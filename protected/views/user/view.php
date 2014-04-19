<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);


?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
		'fname',
		'mname',
		'lname',
		'pic_url',
		'activated',
		'activation_chain',
		'disable',
		'biography',
		'linkedin_id',
		'fiucs_id',
		'google_id',
		'isAdmin',
		'isProMentor',
		'isPerMentor',
		'isDomMentor',
		'isStudent',
		'isMentee',
		'isJudge',
		'isEmployer',
	),
)); ?>
