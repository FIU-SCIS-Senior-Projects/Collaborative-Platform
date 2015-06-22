<?php
/* @var $this ReassignRulesController */
/* @var $model ReassignRules */

$this->breadcrumbs=array(
	'Reassign Rules'=>array('index'),
	'Manage',
);

//$this->menu=array(
	//array('label'=>'List ReassignRules', 'url'=>array('index')),
	//array('label'=>'Create ReassignRules', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reassign-rules-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Reassign Rules</h1>

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
	'id'=>'reassign-rules-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'rule_id',
		'rule',
		'setting',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
		),
	),
)); ?>
<p><b>Rule 1 Details:</b> When a ticket times out, that is there has been no comments or VCs made on the ticket by the mentor<br/>
and the ticket was assigned to the mentor for longer then the tickets priority hours, it is reassigned to a new mentor.<br/>
when this happens THIS RULE'S many times the ticket will be assigned to the system admin for manually reassignment.<br/><br/>
<b>Rule 2 Details:</b> When the system receives an automated out of office email from a mentor, it saves them on a list of<br/>
mentors that will not be assigned tickets by the system.  THIS RULE determines how many days they are on that list. <br/><br/>
<b>Rule 3 Details:</b>  Also when the system detects an out of office email from the mentor, it will select a number of tickets<br/>
from the mentors ticket list and reassign them.  THIS RULE determines how long ago should the system look for tickets,<br/>
in other words any ticket assigned less than this many hours ago will be reassigned.</p>
