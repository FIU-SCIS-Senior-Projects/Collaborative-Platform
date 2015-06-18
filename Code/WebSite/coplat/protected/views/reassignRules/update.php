<?php
/* @var $this ReassignRulesController */
/* @var $model ReassignRules */

$this->breadcrumbs=array(
	'Reassign Rules'=>array('index'),
	$model->rule_id=>array('view','id'=>$model->rule_id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List ReassignRules', 'url'=>array('index')),
//	array('label'=>'Create ReassignRules', 'url'=>array('create')),
//	array('label'=>'View ReassignRules', 'url'=>array('view', 'id'=>$model->rule_id)),
	array('label'=>'Manage ReassignRules', 'url'=>array('admin')),
);
?>

<h1>Update ReassignRules <?php echo $model->rule_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>