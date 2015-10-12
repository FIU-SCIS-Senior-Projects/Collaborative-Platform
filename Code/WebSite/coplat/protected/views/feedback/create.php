<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Feedback', 'url'=>array('index')),
	array('label'=>'Manage Feedback', 'url'=>array('admin')),
);
?>

<h1>Create Feedback</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>