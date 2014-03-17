<?php
/* @var $this ProjectMentorController */
/* @var $model ProjectMentor */

$this->breadcrumbs=array(
	'Project Mentors'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProjectMentor', 'url'=>array('index')),
	array('label'=>'Create ProjectMentor', 'url'=>array('create')),
	array('label'=>'View ProjectMentor', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage ProjectMentor', 'url'=>array('admin')),
);
?>

<h1>Update ProjectMentor <?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>