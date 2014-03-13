<?php
/* @var $this AttachmentController */
/* @var $data Attachment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_type')); ?>:</b>
	<?php echo CHtml::encode($data->file_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_url')); ?>:</b>
	<?php echo CHtml::encode($data->file_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_id')); ?>:</b>
	<?php echo CHtml::encode($data->ticket_id); ?>
	<br />


</div>