<?php
/* @var $this Feedback_RepliesController */
/* @var $model Feedback_Replies */

$this->breadcrumbs=array(
	'Feedback_Replies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Return to Feedback', 'url'=>'(__DIR__)."/../../feedback/view/'.$model->feed_id),
	/*array('label'=>'Create Feedback_Replies', 'url'=>array('create')),
	array('label'=>'Update Feedback_Replies', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Feedback_Replies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Feedback_Replies', 'url'=>array('admin')),*/
);
?>

<h1>View Feedback_Replies #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'feed_id',
		'reply',
		'user_id',
	),
)); ?>
