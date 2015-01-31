<?php
/* @var $this ApplicationDomainMentorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Application Domain Mentors',
);

$this->menu=array(
	array('label'=>'Create ApplicationDomainMentor', 'url'=>array('create')),
	array('label'=>'Manage ApplicationDomainMentor', 'url'=>array('admin')),
);
?>

<h1>Application Domain Mentors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
