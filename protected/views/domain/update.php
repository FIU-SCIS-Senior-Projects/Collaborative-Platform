<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Domains'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Domain', 'url'=>array('index')),
	array('label'=>'Create Domain', 'url'=>array('create')),
	array('label'=>'View Domain', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Domain', 'url'=>array('admin')),
);*/
?>

<h2>Update Domain: <?php echo $model->name; ?></h2>

<?php echo $this->renderPartial('change', array('model'=>$model)); ?>