<?php
/* @var $this AdministratorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Administrators',
);

$this->menu=array(
	array('label'=>'Create Administrator', 'url'=>array('create')),
	array('label'=>'Manage Administrator', 'url'=>array('admin')),
);
?>

<h1>Administrators</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
