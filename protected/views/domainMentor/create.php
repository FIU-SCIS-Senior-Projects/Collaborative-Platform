<?php
/* @var $this DomainMentorController */
/* @var $model DomainMentor */

$this->breadcrumbs=array(
	'Domain Mentors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DomainMentor', 'url'=>array('index')),
	array('label'=>'Manage DomainMentor', 'url'=>array('admin')),
);
?>

<h1>Create DomainMentor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>