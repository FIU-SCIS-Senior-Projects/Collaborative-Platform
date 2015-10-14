<?php
/* @var $this FeedbackrepliesController */
/* @var $model feedbackreplies */

$this->breadcrumbs=array(
	'Feedbackreplies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Return to Feedback', 'url'=>'(__DIR__)."/../../feedback/view/'.$model->feed_id),
	/*array('label'=>'Create feedbackreplies', 'url'=>array('create')),
	array('label'=>'Update feedbackreplies', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete feedbackreplies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage feedbackreplies', 'url'=>array('admin')),*/
);
?>

<h1>View feedbackreplies #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'feed_id',
		'reply',
		'user_id',
	),
)); ?>
