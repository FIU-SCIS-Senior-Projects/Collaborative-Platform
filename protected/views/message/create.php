<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);*/
?>

<?php echo $this->renderPartial('view', array('model'=>$model)); ?>