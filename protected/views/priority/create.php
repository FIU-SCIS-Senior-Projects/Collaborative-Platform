<?php
/* @var $this PriorityController */
/* @var $model Priority */

$this->breadcrumbs=array(
	'Priorities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Priority', 'url'=>array('index')),
	array('label'=>'Manage Priority', 'url'=>array('admin')),
);
?>

<h1>Create Priority</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>