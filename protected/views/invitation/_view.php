<?php
/* @var $this InvitationController */
/* @var $data Invitation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('administrator_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->administrator_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('administrator')); ?>:</b>
	<?php echo CHtml::encode($data->administrator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mentor')); ?>:</b>
	<?php echo CHtml::encode($data->mentor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mentee')); ?>:</b>
	<?php echo CHtml::encode($data->mentee); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('employer')); ?>:</b>
	<?php echo CHtml::encode($data->employer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge')); ?>:</b>
	<?php echo CHtml::encode($data->judge); ?>
	<br />

	*/ ?>

</div>