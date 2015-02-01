<?php
/* @var $this DomainMentorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Domain Mentors',
);

$this->menu=array(
	array('label'=>'Create DomainMentor', 'url'=>array('create')),
	array('label'=>'Manage DomainMentor', 'url'=>array('admin')),
);
?>

<h1>Domain Mentors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
