<?php
/* @var $this ApplicationPersonalMentorController */
/* @var $model ApplicationPersonalMentor */

$this->breadcrumbs=array(
	'Application Personal Mentors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicationPersonalMentor', 'url'=>array('index')),
	array('label'=>'Create ApplicationPersonalMentor', 'url'=>array('create')),
	array('label'=>'View ApplicationPersonalMentor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ApplicationPersonalMentor', 'url'=>array('admin')),
);
?>

<h1>Update ApplicationPersonalMentor <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>