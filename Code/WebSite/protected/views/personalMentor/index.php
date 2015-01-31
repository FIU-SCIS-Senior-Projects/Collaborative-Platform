<?php
/* @var $this PersonalMentorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personal Mentors',
);

$this->menu=array(
	array('label'=>'Create PersonalMentor', 'url'=>array('create')),
	array('label'=>'Manage PersonalMentor', 'url'=>array('admin')),
);
?>

<h1>Personal Mentors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
