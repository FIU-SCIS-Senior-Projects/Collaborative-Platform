<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Tickets', 'url'=>array('index')),
	//array('label'=>'Create Priority', 'url'=>array('create')),
);

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

<h1>Old Tickets</h1>



</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ticket-grid',
	'dataProvider'=>$model->searchOld(),
	'filter'=>$model,
	'columns'=>array(
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
        'subject',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}',
		),
	),
)); ?>
