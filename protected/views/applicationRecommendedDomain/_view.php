<?php
/* @var $this ApplicationRecommendedDomainController */
/* @var $data ApplicationRecommendedDomain */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appId')); ?>:</b>
	<?php echo CHtml::encode($data->appId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domain')); ?>:</b>
	<?php echo CHtml::encode($data->domain); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdomain')); ?>:</b>
	<?php echo CHtml::encode($data->subdomain); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proficiency')); ?>:</b>
	<?php echo CHtml::encode($data->proficiency); ?>
	<br />


</div>