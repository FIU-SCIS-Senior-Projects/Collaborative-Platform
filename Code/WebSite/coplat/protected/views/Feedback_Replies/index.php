<?php
/* @var $this Feedback_RepliesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Feedback_Replies',
);

$this->menu=array(
	array('label'=>'Create Feedback_Replies', 'url'=>array('create')),
	array('label'=>'Manage Feedback_Replies', 'url'=>array('admin')),
);
?>

<h1>Feedback_Replies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
