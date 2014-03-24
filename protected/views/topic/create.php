<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	'Create',
);
/*
$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);
*/
?>

<h2>Create Topic</h2>

<?php echo $this->renderPartial('add', array('model'=>$model)); ?>