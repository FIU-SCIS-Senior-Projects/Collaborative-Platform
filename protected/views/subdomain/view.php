<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */

$this->breadcrumbs=array(
	'Manage Sub-Domains'=>array('admin'),
	$model->name,
);

?>

<h2><?php echo $model->name; ?> Subdomain</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'validator',
		'domain_id',
	),
)); ?>
