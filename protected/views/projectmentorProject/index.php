<?php
/* @var $this ProjectmentorProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Projectmentor Projects',
);

$this->menu=array(
	array('label'=>'Create ProjectmentorProject', 'url'=>array('create')),
	array('label'=>'Manage ProjectmentorProject', 'url'=>array('admin')),
);
?>

<h1>Projectmentor Projects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
