<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Manage Domains',
);

?>

<h2>Manage Domains</h2>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'domain-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'description',
		//'validator',
		'need',
		'need_amount',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
