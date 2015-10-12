<?php
/* @var $this FeedbackrepliesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Feedbackreplies',
);

$this->menu=array(
	array('label'=>'Create feedbackreplies', 'url'=>array('create')),
	array('label'=>'Manage feedbackreplies', 'url'=>array('admin')),
);
?>

<h1>Feedbackreplies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
