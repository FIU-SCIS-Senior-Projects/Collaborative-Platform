<?php
/* @var $this PersonalMentorController */
/* @var $model PersonalMentor */

$this->breadcrumbs=array(
	'Personal Mentors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PersonalMentor', 'url'=>array('index')),
	array('label'=>'Manage PersonalMentor', 'url'=>array('admin')),
);
?>

<h1>Create PersonalMentor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>