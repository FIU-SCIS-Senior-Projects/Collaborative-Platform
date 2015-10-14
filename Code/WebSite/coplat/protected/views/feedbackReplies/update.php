<?php
/* @var $this FeedbackrepliesController */
/* @var $model feedbackreplies */

$this->breadcrumbs=array(
	'Feedbackreplies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List feedbackreplies', 'url'=>array('index')),
	array('label'=>'Create feedbackreplies', 'url'=>array('create')),
	array('label'=>'View feedbackreplies', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage feedbackreplies', 'url'=>array('admin')),
);
?>

<h1>Update feedbackreplies <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>