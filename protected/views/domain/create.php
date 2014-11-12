<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Manage Domains'=>array('admin'),
	'Create Domain',
);

/*$this->menu=array(
	array('label'=>'List Domain', 'url'=>array('index')),
	array('label'=>'Manage Domain', 'url'=>array('admin')),
);*/
?>

<h2>Create Domain</h2>

<?php echo $this->renderPartial('add', array('model'=>$model)); ?>