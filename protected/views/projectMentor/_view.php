<?php
/* @var $this ProjectMentorController */
/* @var $data ProjectMentor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_role_user_id), array('view', 'id'=>$data->user_role_user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_role_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_role_role_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_hours')); ?>:</b>
	<?php echo CHtml::encode($data->max_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_projects')); ?>:</b>
	<?php echo CHtml::encode($data->max_projects); ?>
	<br />


</div>