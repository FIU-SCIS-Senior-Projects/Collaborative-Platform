<?php
/* @var $this SubdomainController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subdomains',
);

$this->menu=array(
	array('label'=>'Create Subdomain', 'url'=>array('create')),
	array('label'=>'Manage Subdomain', 'url'=>array('admin')),
);
?>

<h1>Subdomains</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
