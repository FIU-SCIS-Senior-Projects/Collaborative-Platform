<?php
/* @var $this DomainSuggestionController */
/* @var $model DomainSuggestion */

$this->breadcrumbs=array(
	'Domain Suggestions'=>array('index'),
	'Create',
);

$this->menu=array(

);
?>

<h1>Suggest New Domain</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>