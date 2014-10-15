<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $data1 creatorUser */
/* @var $data2 assignedUser */
/* @var $data3 domainName */
/* @var $data4 subDomainName */


$this->breadcrumbs=array(
    'Manage Tickets',
);

// $this->menu=array(
// 	array('label'=>'List Ticket', 'url'=>array('index')),
// 	array('label'=>'Create Ticket', 'url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ticket-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tickets</h1>

<!-- <p> -->
<!-- You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> -->
<!-- or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done. -->
<!-- </p> -->

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array('model'=>$model,'data1'=>$data1, 'data2'=>$data2,'data3'=>$data3,'data4'=>$data4,)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ticket-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'created_date',
		//'id',
		//'creator_user_id',
        array(
        	'name'  => 'creatorName',
            'value' => '($data->getCompiledCreatorID())',
            'header'=> CHtml::encode($model->getAttributeLabel('creator_user_id')),
            'filter'=> CHtml::activeTextField($model, 'creatorName'),
        ),
			'assigned_date',
        array(
            'name'  => 'assignedName',
            'value' => '($data->getCompiledAssignedID())',
            'header'=> CHtml::encode($model->getAttributeLabel('assign_user_id')),
            'filter'=> CHtml::activeTextField($model, 'assignedName'),
        ),

		//'subject',
		//'description',
		//'assign_user_id',
		//'domain_id',
		array(
			'name'  => 'domainName',
			'value' => '($data->getDomainID())',
			'header'=> CHtml::encode($model->getAttributeLabel('domain_id')),
			'filter'=> CHtml::activeTextField($model, 'domainName'),
		),
		//'subdomain_id',
			array(
			'name'  => 'subDomainName',
			'value' => '($data->getSubDomainID())',
			'header'=> CHtml::encode($model->getAttributeLabel('subdomain_id')),
			'filter'=> CHtml::activeTextField($model, 'subDomainName'),
			),
		//'file',
		'closed_date',
		'status',
				
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
