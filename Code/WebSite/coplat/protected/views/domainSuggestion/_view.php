<?php
/* @var $this DomainSuggestionController */
/* @var $data DomainSuggestion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('suggestion_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->suggestion_id), array('view', 'id'=>$data->suggestion_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creator_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->creator_user_id); ?>
	<br />


</div>