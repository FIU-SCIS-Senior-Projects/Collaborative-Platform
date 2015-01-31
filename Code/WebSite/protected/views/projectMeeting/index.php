<?php
/* @var $this ProjectMeetingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Project Meetings',
);

$this->menu=array(
	array('label'=>'Create ProjectMeeting', 'url'=>array('create')),
	array('label'=>'Manage ProjectMeeting', 'url'=>array('admin')),
);
?>

<h1>Project Meetings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
