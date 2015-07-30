<?php
/* @var $this DomainSuggestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Domain Suggestions',
);

$this->menu=array(

);
?>

<h1>Domain Suggestions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
