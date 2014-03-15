<?php
/* @var $this MenteeController */
/* @var $data Mentee */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_role_user_id), array('view', 'id'=>$data->user_role_user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_role_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_role_role_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_mentor_user_role_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_mentor_user_role_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectmentor_project_project_mentor_user_role_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->projectmentor_project_project_mentor_user_role_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectmentor_project_project_id')); ?>:</b>
	<?php echo CHtml::encode($data->projectmentor_project_project_id); ?>
	<br />


</div>