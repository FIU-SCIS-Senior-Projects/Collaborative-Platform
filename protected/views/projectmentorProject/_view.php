<?php
/* @var $this ProjectmentorProjectController */
/* @var $data ProjectmentorProject */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_mentor_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_mentor_user_id); ?>
	<br />


</div>