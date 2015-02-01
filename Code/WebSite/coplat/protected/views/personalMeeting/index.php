<?php
/* @var $this PersonalMeetingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personal Meetings',
);

$this->menu=array(
	array('label'=>'Create PersonalMeeting', 'url'=>array('create')),
	array('label'=>'Manage PersonalMeeting', 'url'=>array('admin')),
);
?>

<h1>Personal Meetings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
