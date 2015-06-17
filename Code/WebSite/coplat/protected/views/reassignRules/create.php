<?php
/* @var $this ReassignRulesController */
/* @var $model ReassignRules */

$this->breadcrumbs=array(
	'Reassign Rules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReassignRules', 'url'=>array('index')),
	array('label'=>'Manage ReassignRules', 'url'=>array('admin')),
);
?>

<h1>Create ReassignRules</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>