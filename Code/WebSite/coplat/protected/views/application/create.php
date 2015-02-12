<?php
/* @var $this ApplicationController */
/* @var $model Application */

$this->breadcrumbs=array(
	'Applications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Application', 'url'=>array('index')),
	array('label'=>'Manage Application', 'url'=>array('admin')),
);
?>

<h1>Create Application</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>