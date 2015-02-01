<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Manage Projects'=>array('admin'),
	'Add',
);

?>

<h2>Add New Project</h2>

<?php echo $this->renderPartial('add', array('model'=>$model)); ?>