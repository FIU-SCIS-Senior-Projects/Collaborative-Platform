<?php
/* @var $this ApplicationProjectMentorController */
/* @var $model ApplicationProjectMentor */

$this->breadcrumbs=array(
	'Application Project Mentors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicationProjectMentor', 'url'=>array('index')),
	array('label'=>'Create ApplicationProjectMentor', 'url'=>array('create')),
	array('label'=>'View ApplicationProjectMentor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ApplicationProjectMentor', 'url'=>array('admin')),
);
?>

<h1>Update ApplicationProjectMentor <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>