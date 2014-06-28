<?php
/* @var $this PriorityController */
/* @var $model Priority */

$this->breadcrumbs=array(
	'Priorities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Priority', 'url'=>array('index')),
	array('label'=>'Create Priority', 'url'=>array('create')),
	array('label'=>'View Priority', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Priority', 'url'=>array('admin')),
);
?>

<h1>Update Priority <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>