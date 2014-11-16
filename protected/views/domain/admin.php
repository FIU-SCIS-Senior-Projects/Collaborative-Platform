<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Manage Domains',
);

?>

<h2>Domains</h2>

<a href=../domain/create>
<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'label'=>'Add New Domain',
		'icon'=>'plus white',
		'size'=>'small',
		'type'=> 'success',
		));?>
</a>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'domain-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'description',
		'validator',
		'need',
		'need_amount',
		array(
    				'header'=>'Options',
    				'class'=>'bootstrap.widgets.TbButtonColumn',
    				'template'=> '{view} {delete}',
    				'buttons'=>array(
    						'view'=>
    						array(
    								'url'=>'Yii::app()->createUrl("domain/viewmodal", array("id"=>$data->id))',
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
)); ?><hr>
	
<!-- SUBDOMAIN SECTION (ROUTE TO CONTROLLER) -->
<?php Yii::app()->runController('/subdomain/admin'); ?>


<!-- View Popup  -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'viewModal', 'htmlOptions' => ['style' => 'width: 800px; margin-left: -400px'])); ?>
<!-- Popup Header -->

<div class="modal-header">
    <h4></h4>

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


