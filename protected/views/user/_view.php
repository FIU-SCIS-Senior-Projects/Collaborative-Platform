<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mname')); ?>:</b>
	<?php echo CHtml::encode($data->mname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pic_url')); ?>:</b>
	<?php echo CHtml::encode($data->pic_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activated')); ?>:</b>
	<?php echo CHtml::encode($data->activated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activation_chain')); ?>:</b>
	<?php echo CHtml::encode($data->activation_chain); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disable')); ?>:</b>
	<?php echo CHtml::encode($data->disable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('biography')); ?>:</b>
	<?php echo CHtml::encode($data->biography); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('linkedin_id')); ?>:</b>
	<?php echo CHtml::encode($data->linkedin_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fiucs_id')); ?>:</b>
	<?php echo CHtml::encode($data->fiucs_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_id')); ?>:</b>
	<?php echo CHtml::encode($data->google_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isAdmin')); ?>:</b>
	<?php echo CHtml::encode($data->isAdmin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isProMentor')); ?>:</b>
	<?php echo CHtml::encode($data->isProMentor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isPerMentor')); ?>:</b>
	<?php echo CHtml::encode($data->isPerMentor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isDomMentor')); ?>:</b>
	<?php echo CHtml::encode($data->isDomMentor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isStudent')); ?>:</b>
	<?php echo CHtml::encode($data->isStudent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isMentee')); ?>:</b>
	<?php echo CHtml::encode($data->isMentee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isJudge')); ?>:</b>
	<?php echo CHtml::encode($data->isJudge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isEmployer')); ?>:</b>
	<?php echo CHtml::encode($data->isEmployer); ?>
	<br />

	*/ ?>

</div>