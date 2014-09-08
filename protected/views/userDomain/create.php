<?php
/* @var $this UserDomainController */
/* @var $model UserDomain */

$this->breadcrumbs=array(
	'User Domains'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserDomain', 'url'=>array('index')),
	array('label'=>'Manage UserDomain', 'url'=>array('admin')),
);
?>

<h1>Create UserDomain</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>