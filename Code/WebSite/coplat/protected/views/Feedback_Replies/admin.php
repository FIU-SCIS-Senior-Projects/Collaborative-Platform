<?php
/* @var $this Feedback_RepliesController */
/* @var $model Feedback_Replies */

$this->breadcrumbs=array(
	'Feedback_Replies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Feedback_Replies', 'url'=>array('index')),
	array('label'=>'Create Feedback_Replies', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#Feedback_Replies-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Feedback_Replies</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'Feedback_Replies-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'feed_id',
		'reply',
		'user_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
