<?php
/* @var $this VideoConferenceController */
/* @var $data VideoConference */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moderator_id')); ?>:</b>
	<?php echo CHtml::encode($data->moderator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scheduled_on')); ?>:</b>
	<?php echo CHtml::encode($data->scheduled_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scheduled_for')); ?>:</b>
	<?php echo CHtml::encode($data->scheduled_for); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />


</div>