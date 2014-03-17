<?php
/* @var $this AdministratorController */
/* @var $model Administrator */

$this->breadcrumbs=array(
	'Administrators'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Administrator', 'url'=>array('index')),
	array('label'=>'Create Administrator', 'url'=>array('create')),
	array('label'=>'View Administrator', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage Administrator', 'url'=>array('admin')),
);
?>

<h1>Update Administrator <?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>