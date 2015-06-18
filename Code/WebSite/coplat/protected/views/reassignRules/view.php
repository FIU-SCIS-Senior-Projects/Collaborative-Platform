<?php
/* @var $this ReassignRulesController */
/* @var $model ReassignRules */

$this->breadcrumbs=array(
	'Reassign Rules'=>array('index'),
	$model->rule_id,
);

$this->menu=array(
	array('label'=>'List ReassignRules', 'url'=>array('index')),
//	array('label'=>'Create ReassignRules', 'url'=>array('create')),
	array('label'=>'Update ReassignRules', 'url'=>array('update', 'id'=>$model->rule_id)),
//	array('label'=>'Delete ReassignRules', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rule_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReassignRules', 'url'=>array('admin')),
);
?>

<h1>View ReassignRules #<?php echo $model->rule_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rule_id',
		'rule',
		'setting',
	),
)); ?>
