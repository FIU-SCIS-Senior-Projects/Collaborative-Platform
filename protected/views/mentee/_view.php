<?php
/* @var $this MenteeController */
/* @var $data Mentee */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectmentor_project_id')); ?>:</b>
	<?php echo CHtml::encode($data->projectmentor_project_id); ?>
	<br />


</div>