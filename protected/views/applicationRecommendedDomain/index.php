<?php
/* @var $this ApplicationRecommendedDomainController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Application Recommended Domains',
);

$this->menu=array(
	array('label'=>'Create ApplicationRecommendedDomain', 'url'=>array('create')),
	array('label'=>'Manage ApplicationRecommendedDomain', 'url'=>array('admin')),
);
?>

<h1>Application Recommended Domains</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
