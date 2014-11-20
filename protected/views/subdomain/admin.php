<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */
?>

<h2>Sub-Domains</h2>

<a href=../subdomain/create>
<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'label'=>'Add New Sub-Domain',
		'icon'=>'plus white',
		'size'=>'small',
		'type'=> 'success',
		));?>
</a>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'subdomain-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
 		 array(
        	'name'  => 'domainName',
			'value'=>'$data->getDomainName()',
 			'header'=> 'Domain',
            'filter'=> CHtml::activeTextField($model, 'domainName'),
 		),		
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
    								'url'=>'Yii::app()->createUrl("subdomain/viewmodal", array("id"=>$data->id))',
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


