<?php
/* @var $this ApplicationRecommendedDomainController */
/* @var $model ApplicationRecommendedDomain */

$this->breadcrumbs=array(
	'Application Recommended Domains'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicationRecommendedDomain', 'url'=>array('index')),
	array('label'=>'Manage ApplicationRecommendedDomain', 'url'=>array('admin')),
);
?>

<h1>Create ApplicationRecommendedDomain</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>