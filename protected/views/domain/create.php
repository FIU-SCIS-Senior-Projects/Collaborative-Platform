<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Domains'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Domain', 'url'=>array('index')),
	array('label'=>'Manage Domain', 'url'=>array('admin')),
);*/
?>

<h2>Add New Domain</h2>

<?php echo $this->renderPartial('add', array('model'=>$model)); ?>