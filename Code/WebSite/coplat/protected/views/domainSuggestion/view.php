<?php
/* @var $this DomainSuggestionController */
/* @var $model DomainSuggestion */

$this->breadcrumbs=array(
	'Domain Suggestions'=>array('index'),
	$model->name,
);

$this->menu=array(

	array('label'=>'Manage DomainSuggestion', 'url'=>array('admin')),
);
?>

<h1>View DomainSuggestion #<?php echo $model->suggestion_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'suggestion_id',
		'name',
		'description',
		'status',
		'creator_user_id',
	),
)); ?>
