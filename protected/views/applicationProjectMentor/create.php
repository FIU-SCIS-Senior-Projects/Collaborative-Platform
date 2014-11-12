<?php
/* @var $this ApplicationProjectMentorController */
/* @var $model ApplicationProjectMentor */

$this->breadcrumbs=array(
	'Application Project Mentors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicationProjectMentor', 'url'=>array('index')),
	array('label'=>'Manage ApplicationProjectMentor', 'url'=>array('admin')),
);
?>

<h1>Create ApplicationProjectMentor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>