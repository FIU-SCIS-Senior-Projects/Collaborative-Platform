<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	$model->name,

);

?>

<h2>Update <?php echo $model->name; ?> Domain</h2>

<?php echo $this->renderPartial('change', array('model'=>$model)); ?>