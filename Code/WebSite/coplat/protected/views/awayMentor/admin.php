<?php
/* @var $this AwayMentorController */
/* @var $model AwayMentor */

$this->breadcrumbs=array(
    'Away Mentors'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List AwayMentor', 'url'=>array('index')),
    array('label'=>'Create AwayMentor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#away-mentor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Away Mentors</h1>

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
    'id'=>'away-mentor-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'userID',
        array('name'=>'user_search','value'=>'$data->user->username'),
        array('name'=>'name_search','value'=>'$data->user->getFullName()'),
        'tiStamp',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{delete}',
        ),
    ),
)); ?>
