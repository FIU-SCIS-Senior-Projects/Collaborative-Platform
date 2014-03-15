<?php
/* @var $this DomainMentorController */
/* @var $data DomainMentor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_role_user_id), array('view', 'id'=>$data->user_role_user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_role_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_role_role_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_tickets')); ?>:</b>
	<?php echo CHtml::encode($data->max_tickets); ?>
	<br />


</div>