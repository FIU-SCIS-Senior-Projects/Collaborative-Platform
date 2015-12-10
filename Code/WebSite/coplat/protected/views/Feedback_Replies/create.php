<?php
/* @var $this Feedback_RepliesController */
/* @var $model Feedback_Replies */

$this->breadcrumbs=array(
	'Feedback_Replies'=>array('index'),
	'Create',
);

?>

<h1>Create Reply</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>