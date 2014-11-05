<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Manage Projects',

);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#project-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Manage Projects</h2>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'project-grid',
	'type'=>'striped condensed hover',	
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
			array(
					'name'=>'description',
            		'header'=> CHtml::encode($model->getAttributeLabel('description')),
					'value' => '($data->getShortDescription())',					
),
		//'description',
		//'propose_by_user_id',
		//'project_mentor_user_id',
		'start_date',
		'due_date',
		array(
    				'header'=>'Options',
    				'class'=>'bootstrap.widgets.TbButtonColumn',
    				'template'=> '{view}',
    				'buttons'=>array(
    						'view'=>
    						array(
    								'url'=>'Yii::app()->createUrl("project/viewmodal", array("id"=>$data->id))',
    								'options'=>array(
    										'ajax'=>array(
    												'type'=>'POST',
    												'url'=>"js:$(this).attr('href')",
    												'success'=>'function(data) { $("#viewModal .modal-body p").html(data); $("#viewModal").modal(); }'
    										),
    								),
    						),
    				),
    		) 
	),
)); ?>


<!-- View Popup  -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'viewModal', 'htmlOptions' => ['style' => 'width: 800px; margin-left: -400px'])); ?>
<!-- Popup Header -->

<div class="modal-header">
</div>

<!-- Popup Content -->
<div class="modal-body">
    <p></p>

</div>
<!-- Popup Footer -->
<div class="modal-footer">

    <!-- close button -->
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <!-- close button ends-->
</div>
<?php $this->endWidget(); ?>
<!-- View Popup ends -->