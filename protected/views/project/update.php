<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Manage Projects'=>array('admin'),
	$model->title,
);

?>

<h1>Update Project <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('change', array('model'=>$model)); ?>