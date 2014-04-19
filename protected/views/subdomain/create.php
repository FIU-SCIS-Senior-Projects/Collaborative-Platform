<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */

$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	'Create',
);

/*-$this->menu=array(
	array('label'=>'List Subdomain', 'url'=>array('index')),
	array('label'=>'Manage Subdomain', 'url'=>array('admin')),
);*/
?>

<h2>Create Sub-Domain</h2>

<?php echo $this->renderPartial('add', array('model'=>$model)); ?>