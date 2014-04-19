<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */

$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	$model->name,
);

?>

<h2>Update <?php echo $model->name; ?> Sub-Domain</h2>

<?php echo $this->renderPartial('change', array('model'=>$model)); ?>