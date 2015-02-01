<?php
/* @var $this InvitationController */
/* @var $model Invite */

Yii::app()->clientScript->registerScript('modal', "
$('.details-button').click(function(){
	$('.details-form').toggle();
	return false;
});
		
		$('.resends-button').click(function(){
	$('.resends-form').toggle();
	return false;
});
");
?>

<!-- INVITE DETAILS START -->
<div class='well details-form' style="display:none">
<h3><?php echo CHtml::link('Invite Details','#',array('class'=>'details-button')); ?></h3>
</div>

<div class='well details-form' style="display:">
<h3><?php echo CHtml::link('Invite Details - ' . $model->id,'#',array('class'=>'details-button')); ?></h3>
<hr>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
					'label'=>'id',
					'type'=>'raw',
					'value'=>CHtml::encode($model->id),
			),
			array(
					'label'=>'email',
					'type'=>'raw',
					'value'=> CHtml::encode($model->email),
			),
			array(
					'label'=>'Date',
					'type'=>'raw',
					'value'=> CHtml::encode($model->date),
			),
			array(
					'label'=>'Administrator',
					'type'=>'raw',
					'value'=> CHtml::encode($model->administrator),
			),
		),
)); 
?>
</div>
<!-- INVITE DETAILS END -->

<!-- RESENDS START -->
<div class='well resends-form' style="display:">
<h3><?php echo CHtml::link('Re-Invitations','#',array('class'=>'resends-button')); ?></h3>
</div>

<div class='well resends-form' style="display:none">
<h3><?php echo CHtml::link('Re-Invitations','#',array('class'=>'resends-button')); ?></h3>
<hr>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'dataProvider'=>new CArrayDataProvider($model->invitationResends, array('keyField'=>'id')),
		'summaryText'=>'',
		'columns'=>array(
			array(
                    			'name'=>'id',
        						'value'=>'$data->id',
                    			'header'=>'ID',
						),
			array(
                    			'name'=>'send_date',
        						'value'=>'$data->send_date',
                    			'header'=>'Send Date',
						),
		),
)); 
?>
</div>
<!-- RESENDS END -->