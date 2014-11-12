<?php
/* @var $this ApplicationRecommendedDomainController */
/* @var $model ApplicationRecommendedDomain */

$this->breadcrumbs=array(
	'Application Recommended Domains'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicationRecommendedDomain', 'url'=>array('index')),
	array('label'=>'Create ApplicationRecommendedDomain', 'url'=>array('create')),
	array('label'=>'View ApplicationRecommendedDomain', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ApplicationRecommendedDomain', 'url'=>array('admin')),
);
?>

<h1>Update ApplicationRecommendedDomain <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>