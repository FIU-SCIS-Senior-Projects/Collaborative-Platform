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
<p><b>Rule 1 Details:</b> When a ticket is created, the ticket creator sets the priority of the ticket.  This determines<br/>
how many hours the mentor, assigned the ticket, has to either comment on the ticket or schedule a video conference with <br/>
the ticket creator.  If mentor does not do one of these two things within the alloted time the ticket will be reassigned,<br/>
and after a set number of reassigns the ticket will be assigned to the system administrator for manual reassignment.  This<br/>>
rule determines how many reassigns before it is assigned to the system admin.<br/><br/>
<b>Rule 2 Details:</b> When the system receives an automated out of office email from a mentor, it sets them to not be able<br/>
to be assigned new tickets for a certain number of days.  This rule determines the number of days they are not bale to <br/>
receive tickets.  They are also able to click a link either from their homepage or on an email sent out that will allow <br/>
them to start being assigned tickets once more.<br/><br/>
<b>Rule 3 Details:</b>  When the system receives an automated out of office email from a mentor it collects all the <br/>
tickets assigned to the mentor that have been assigned to them within the past certain number of hours.  It then reassigns<br/>
all of these tickets.  This rule determines the number of hours.<br/></p>
