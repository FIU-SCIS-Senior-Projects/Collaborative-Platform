<?php
/* @var $this ProjectMeetingController */
/* @var $model ProjectMeeting */

$this->breadcrumbs=array(
	'Project Meetings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProjectMeeting', 'url'=>array('index')),
	array('label'=>'Manage ProjectMeeting', 'url'=>array('admin')),
);
?>

<h1>Create ProjectMeeting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>