<?php
/* @var $this ProjectmentorProjectController */
/* @var $model ProjectmentorProject */

$this->breadcrumbs=array(
	'Projectmentor Projects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProjectmentorProject', 'url'=>array('index')),
	array('label'=>'Create ProjectmentorProject', 'url'=>array('create')),
	array('label'=>'Update ProjectmentorProject', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProjectmentorProject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectmentorProject', 'url'=>array('admin')),
);
?>

<h1>View ProjectmentorProject #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_id',
		'project_mentor_user_id',
	),
)); ?>
