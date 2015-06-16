<?php
/* @var $this ReassignRulesController */
/* @var $data ReassignRules */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rule_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rule_id), array('view', 'id'=>$data->rule_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rule')); ?>:</b>
	<?php echo CHtml::encode($data->rule); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('setting')); ?>:</b>
	<?php echo CHtml::encode($data->setting); ?>
	<br />


</div>