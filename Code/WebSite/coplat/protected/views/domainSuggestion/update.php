<?php
/* @var $this DomainSuggestionController */
/* @var $model DomainSuggestion */

$this->breadcrumbs=array(
	'Domain Suggestions'=>array('index'),
	$model->name=>array('view','id'=>$model->suggestion_id),
	'Update',
);

$this->menu=array(

);
?>

<h1>Update DomainSuggestion <?php echo $model->suggestion_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>