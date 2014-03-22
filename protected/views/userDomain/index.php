<?php
/* @var $this UserDomainController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Domains',
);

$this->menu=array(
	array('label'=>'Create UserDomain', 'url'=>array('create')),
	array('label'=>'Manage UserDomain', 'url'=>array('admin')),
);
?>

<h1>User Domains</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
