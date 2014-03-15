<?php
/* @var $this PersonalMentorController */
/* @var $model PersonalMentor */

$this->breadcrumbs=array(
	'Personal Mentors'=>array('index'),
	$model->user_role_user_id=>array('view','id'=>$model->user_role_user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PersonalMentor', 'url'=>array('index')),
	array('label'=>'Create PersonalMentor', 'url'=>array('create')),
	array('label'=>'View PersonalMentor', 'url'=>array('view', 'id'=>$model->user_role_user_id)),
	array('label'=>'Manage PersonalMentor', 'url'=>array('admin')),
);
?>

<h1>Update PersonalMentor <?php echo $model->user_role_user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>