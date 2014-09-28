<?php
/* @var $this SubdomainController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sub-Domains',
);

?>

<h2>Sub-Domains</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
