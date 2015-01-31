<?php
/* @var $this ApplicationDomainMentorController */
/* @var $model ApplicationDomainMentor */

$this->breadcrumbs=array(
	'Application Domain Mentors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicationDomainMentor', 'url'=>array('index')),
	array('label'=>'Manage ApplicationDomainMentor', 'url'=>array('admin')),
);
?>

<h1>Create ApplicationDomainMentor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>