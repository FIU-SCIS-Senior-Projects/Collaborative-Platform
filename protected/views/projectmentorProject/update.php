<?php
/* @var $this ProjectmentorProjectController */
/* @var $model ProjectmentorProject */

$this->breadcrumbs=array(
	'Projectmentor Projects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProjectmentorProject', 'url'=>array('index')),
	array('label'=>'Create ProjectmentorProject', 'url'=>array('create')),
	array('label'=>'View ProjectmentorProject', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProjectmentorProject', 'url'=>array('admin')),
);
?>

<h1>Update ProjectmentorProject <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>