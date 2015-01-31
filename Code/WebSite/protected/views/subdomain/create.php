<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */

$this->breadcrumbs=array(
	'Manage Domains'=>array('/domain/admin'),
	'Create Subdomain',
);


?>

<h2>Create Sub-Domain</h2>

<?php echo $this->renderPartial('add', array('model'=>$model)); ?>