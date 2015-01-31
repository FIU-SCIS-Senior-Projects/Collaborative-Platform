<?php
/* @var $this PersonalMeetingController */
/* @var $data PersonalMeeting */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mentee_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->mentee_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_mentor_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_mentor_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />


</div>