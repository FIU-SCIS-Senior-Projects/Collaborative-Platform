<?php
/* @var $this ApplicationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Applications',
);

$this->menu=array(
	array('label'=>'Create Application', 'url'=>array('create')),
	array('label'=>'Manage Application', 'url'=>array('admin')),
);
?>

<h1>Applications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
