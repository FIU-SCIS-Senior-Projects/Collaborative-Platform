<?php
/* @var $this UserDomainController */
/* @var $model UserDomain */

$this->breadcrumbs=array(
	'User Domains'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserDomain', 'url'=>array('index')),
	array('label'=>'Create UserDomain', 'url'=>array('create')),
	array('label'=>'View UserDomain', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserDomain', 'url'=>array('admin')),
);
?>

<h1>Update UserDomain <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>