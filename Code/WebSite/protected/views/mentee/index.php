<?php
/* @var $this MenteeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mentees',
);

$this->menu=array(
	array('label'=>'Create Mentee', 'url'=>array('create')),
	array('label'=>'Manage Mentee', 'url'=>array('admin')),
);
?>

<h1>Mentees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
