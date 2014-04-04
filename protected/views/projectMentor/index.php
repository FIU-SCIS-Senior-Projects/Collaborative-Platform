<?php
/* @var $this ProjectMentorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Project Mentors',
);

$this->menu=array(
	array('label'=>'Create ProjectMentor', 'url'=>array('create')),
	array('label'=>'Manage ProjectMentor', 'url'=>array('admin')),
);
?>

<h1>Project Mentors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
