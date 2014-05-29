<?php
/* @var $this DomainMentorController */
/* @var $model DomainMentor */

$this->breadcrumbs=array(
	'Domain Mentors'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DomainMentor', 'url'=>array('index')),
	array('label'=>'Create DomainMentor', 'url'=>array('create')),
	array('label'=>'View DomainMentor', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage DomainMentor', 'url'=>array('admin')),
);
?>

<h1>Update DomainMentor <?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>