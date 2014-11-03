<?php
/* @var $this ApplicationController */
/* @var $data Application */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_amount')); ?>:</b>
	<?php echo CHtml::encode($data->max_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_hours')); ?>:</b>
	<?php echo CHtml::encode($data->max_hours); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('system_pick_amount')); ?>:</b>
	<?php echo CHtml::encode($data->system_pick_amount); ?>
	<br />

	*/ ?>

</div>