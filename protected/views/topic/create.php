<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);
?>

<h1>Create Topic</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>