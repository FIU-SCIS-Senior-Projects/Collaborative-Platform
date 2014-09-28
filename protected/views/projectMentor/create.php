<?php
/* @var $this ProjectMentorController */
/* @var $model ProjectMentor */

$this->breadcrumbs=array(
	'Project Mentors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProjectMentor', 'url'=>array('index')),
	array('label'=>'Manage ProjectMentor', 'url'=>array('admin')),
);
?>

<h1>Create ProjectMentor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>