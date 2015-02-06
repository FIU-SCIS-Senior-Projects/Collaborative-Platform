<?php
/* @var $this ApplicationDomainMentorController */
/* @var $model ApplicationDomainMentor */

$this->breadcrumbs=array(
	'Application Domain Mentors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicationDomainMentor', 'url'=>array('index')),
	array('label'=>'Create ApplicationDomainMentor', 'url'=>array('create')),
	array('label'=>'View ApplicationDomainMentor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ApplicationDomainMentor', 'url'=>array('admin')),
);
?>

<h1>Update ApplicationDomainMentor <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>