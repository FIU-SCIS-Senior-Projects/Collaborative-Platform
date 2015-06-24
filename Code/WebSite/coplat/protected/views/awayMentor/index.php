<?php
/* @var $this AwayMentorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Away Mentors',
);

$this->menu=array(
	array('label'=>'Create AwayMentor', 'url'=>array('create')),
	array('label'=>'Manage AwayMentor', 'url'=>array('admin')),
);
?>

<h1>Away Mentors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
