<?php
/* @var $this FeedbackrepliesController */
/* @var $model feedbackreplies */

$this->breadcrumbs=array(
	'Feedbackreplies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List feedbackreplies', 'url'=>array('index')),
	array('label'=>'Manage feedbackreplies', 'url'=>array('admin')),
);
?>

<h1>Create feedbackreplies</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>