<?php
/* @var $this PersonalMeetingController */
/* @var $model PersonalMeeting */

$this->breadcrumbs=array(
	'Personal Meetings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PersonalMeeting', 'url'=>array('index')),
	array('label'=>'Manage PersonalMeeting', 'url'=>array('admin')),
);
?>

<h1>Create PersonalMeeting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>