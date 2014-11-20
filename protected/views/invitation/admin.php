<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Manage Invitations',
);
?>

<h2>Manage Invitations</h2>
<a href=../invitation/create>
<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'label'=>'Send New Invite',
		'icon'=>'plus white',
		'size'=>'small',
		'type'=> 'success',
		));?>
</a>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'invitation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
        'date',
        'name',
		'email',
        'administrator_user_id',

		array(
    				'header'=>'Options',
    				'class'=>'bootstrap.widgets.TbButtonColumn',
    				'template'=> '{view} {update} {delete}',
    				'buttons'=>array(
    						'view'=>
    						array(
    								'url'=>'Yii::app()->createUrl("invitation/viewmodal", array("id"=>$data->id))',
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
