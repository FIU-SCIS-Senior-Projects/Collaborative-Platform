<?php
/* @var $this Feedback_RepliesController */
/* @var $model Feedback_Replies */

$this->breadcrumbs=array(
	'Feedback_Replies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Feedback_Replies', 'url'=>array('index')),
	array('label'=>'Create Feedback_Replies', 'url'=>array('create')),
	array('label'=>'View Feedback_Replies', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Feedback_Replies', 'url'=>array('admin')),
);
?>

<h1>Update Feedback_Replies <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>