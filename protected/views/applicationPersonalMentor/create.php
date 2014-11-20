<?php
/* @var $this ApplicationPersonalMentorController */
/* @var $model ApplicationPersonalMentor */

$this->breadcrumbs=array(
	'Application Personal Mentors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicationPersonalMentor', 'url'=>array('index')),
	array('label'=>'Manage ApplicationPersonalMentor', 'url'=>array('admin')),
);
?>

<h1>Create ApplicationPersonalMentor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>