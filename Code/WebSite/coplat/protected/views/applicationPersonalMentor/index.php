<?php
/* @var $this ApplicationPersonalMentorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Application Personal Mentors',
);

$this->menu=array(
	array('label'=>'Create ApplicationPersonalMentor', 'url'=>array('create')),
	array('label'=>'Manage ApplicationPersonalMentor', 'url'=>array('admin')),
);
?>

<h1>Application Personal Mentors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
