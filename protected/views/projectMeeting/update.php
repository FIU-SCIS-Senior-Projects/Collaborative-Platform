<?php
/* @var $this ProjectMeetingController */
/* @var $model ProjectMeeting */

$this->breadcrumbs=array(
	'Project Meetings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProjectMeeting', 'url'=>array('index')),
	array('label'=>'Create ProjectMeeting', 'url'=>array('create')),
	array('label'=>'View ProjectMeeting', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProjectMeeting', 'url'=>array('admin')),
);
?>

<h1>Update ProjectMeeting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>