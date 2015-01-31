<?php
/* @var $this MenteeController */
/* @var $model Mentee */

$this->breadcrumbs=array(
	'Mentees'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mentee', 'url'=>array('index')),
	array('label'=>'Create Mentee', 'url'=>array('create')),
	array('label'=>'View Mentee', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage Mentee', 'url'=>array('admin')),
);
?>

<h1>Update Mentee <?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>