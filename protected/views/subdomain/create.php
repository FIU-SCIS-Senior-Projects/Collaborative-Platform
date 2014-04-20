<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */

$this->breadcrumbs=array(
	'Manage Sub-Domains'=>array('admin'),
	'Create',
);


?>

<h2>Create Sub-Domain</h2>

<?php echo $this->renderPartial('add', array('model'=>$model)); ?>