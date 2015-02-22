<?php
/* @var $this VideoConferenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Video Conferences',
);

$this->menu=array(
	array('label'=>'Create VideoConference', 'url'=>array('create')),
	array('label'=>'Manage VideoConference', 'url'=>array('admin')),
);
?>

<h1>Video Conferences</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
