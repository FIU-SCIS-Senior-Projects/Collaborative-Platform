<?php
/* @var $this PriorityController */
/* @var $model Priority */

$this->breadcrumbs=array(
	'Priorities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Priority', 'url'=>array('index')),
	array('label'=>'Create Priority', 'url'=>array('create')),
	array('label'=>'Update Priority', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Priority', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Priority', 'url'=>array('admin')),
);
?>

<h1>View Priority #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'reassignHours',
	),
)); ?>
