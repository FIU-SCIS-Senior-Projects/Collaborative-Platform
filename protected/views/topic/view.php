<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Create Topic', 'url'=>array('create')),
	array('label'=>'Update Topic', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Topic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);
?>

<h1>View Topic #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'domain_id',
	),
)); ?>
