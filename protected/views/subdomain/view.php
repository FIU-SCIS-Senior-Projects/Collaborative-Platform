<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */

$this->breadcrumbs=array(
	'Subdomains'=>array('index'),
	$model->name,
);

/*$this->menu=array(
	array('label'=>'List Subdomain', 'url'=>array('index')),
	array('label'=>'Create Subdomain', 'url'=>array('create')),
	array('label'=>'Update Subdomain', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Subdomain', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subdomain', 'url'=>array('admin')),
);*/
?>

<h2>View Subdomain #<?php echo $model->id; ?></h2>

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
