<?php
/* @var $this ProjectmentorProjectController */
/* @var $model ProjectmentorProject */

$this->breadcrumbs=array(
	'Projectmentor Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProjectmentorProject', 'url'=>array('index')),
	array('label'=>'Manage ProjectmentorProject', 'url'=>array('admin')),
);
?>

<h1>Create ProjectmentorProject</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>