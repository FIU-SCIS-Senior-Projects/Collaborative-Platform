<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	'Manage',
);
/*
$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Create Topic', 'url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#topic-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Manage Topics</h2>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'topic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		//'description',
		//CHtml::activeLabel(Domain::model()->findByPk('domain_id'), 'id', 'name'),
		'domain_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
