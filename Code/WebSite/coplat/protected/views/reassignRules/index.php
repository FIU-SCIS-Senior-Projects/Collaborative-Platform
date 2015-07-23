<?php
/* @var $this ReassignRulesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reassign Rules',
);

$this->menu=array(
	array('label'=>'Create ReassignRules', 'url'=>array('create')),
	array('label'=>'Manage ReassignRules', 'url'=>array('admin')),
);
?>

<h1>Reassign Rules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
