<?php
/* @var $this ApplicationRecommendedDomainController */
/* @var $model ApplicationRecommendedDomain */

$this->breadcrumbs=array(
	'Application Recommended Domains'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ApplicationRecommendedDomain', 'url'=>array('index')),
	array('label'=>'Create ApplicationRecommendedDomain', 'url'=>array('create')),
	array('label'=>'Update ApplicationRecommendedDomain', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ApplicationRecommendedDomain', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicationRecommendedDomain', 'url'=>array('admin')),
);
?>

<h1>View ApplicationRecommendedDomain #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'appId',
		'domain',
		'subdomain',
		'description',
		'proficiency',
	),
)); ?>
