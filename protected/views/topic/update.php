<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Create Topic', 'url'=>array('create')),
	array('label'=>'View Topic', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);*/
?>

<h2>Update Topic: <?php echo $model->name; ?></h2>

<?php echo $this->renderPartial('add', array('model'=>$model)); ?>