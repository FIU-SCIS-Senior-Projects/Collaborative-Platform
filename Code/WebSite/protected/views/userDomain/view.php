<?php
/* @var $this UserDomainController */
/* @var $model UserDomain */

$this->breadcrumbs=array(
	'User Domains'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserDomain', 'url'=>array('index')),
	array('label'=>'Create UserDomain', 'url'=>array('create')),
	array('label'=>'Update UserDomain', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserDomain', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserDomain', 'url'=>array('admin')),
);
?>

<h1>View UserDomain #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'domain_id',
		'subdomain_id',
		'rate',
		'active',
		'tier_team',
	),
)); ?>
