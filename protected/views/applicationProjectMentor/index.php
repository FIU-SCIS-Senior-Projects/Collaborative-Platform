<?php
/* @var $this ApplicationProjectMentorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Application Project Mentors',
);

$this->menu=array(
	array('label'=>'Create ApplicationProjectMentor', 'url'=>array('create')),
	array('label'=>'Manage ApplicationProjectMentor', 'url'=>array('admin')),
);
?>

<h1>Application Project Mentors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
