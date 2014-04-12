<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */

$this->breadcrumbs=array(
	'Subdomains'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Subdomain', 'url'=>array('index')),
	array('label'=>'Create Subdomain', 'url'=>array('create')),
	array('label'=>'View Subdomain', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Subdomain', 'url'=>array('admin')),
);*/
?>

<h2>Update Sub-Domain <?php echo $model->id; ?></h2>

<?php echo $this->renderPartial('change', array('model'=>$model)); ?>