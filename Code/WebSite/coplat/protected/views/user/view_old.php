<?php
/* @var $this UserController */
/* @var $model User */
if(User::isCurrentUserAdmin())
{
    $this->breadcrumbs=array(
        'Manage Users'=>array('admin'),
        $model->fname,
    );
}


?>

<h2>View User #<?php echo $model->id; ?></h2>

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
