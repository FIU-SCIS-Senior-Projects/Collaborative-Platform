<?php
/* @var $this ApplicationController */
/* @var $user_id UserID */

$this->breadcrumbs=array(
	'Applications'=>array('admin'),
	$user_id,
);
?>


<!-- PERSONAL MENTOR SECTION (ROUTE TO CONTROLLER) -->
<?php 	$persCount = Yii::app()->db->createCommand()->select('COUNT(*)')->
												from('application_personal_mentor')->
												where('status="Admin"')->
         										andWhere('user_id=:id', array(':id'=>$user_id))->
												queryScalar();

		if ($persCount == 1) {?>

<div class='well'>
	<?php Yii::app()->runController('/applicationpersonalmentor/view/'); ?>
</div>
	<?php } else if ($persCount > 1) echo 'Too many entries';?>
<!-- PERSONAL MENTOR SECTION END -->


<!-- PROJECT MENTOR SECTION (ROUTE TO CONTROLLER) -->
<?php 	$projCount = Yii::app()->db->createCommand()->select('COUNT(*)')->
												from('application_project_mentor')->
												where('status="Admin"')->
         										andWhere('user_id=:id', array(':id'=>$user_id))->
												queryScalar();

		if ($projCount == 1) {?>
<div class='well'>
	<?php Yii::app()->runController('/applicationprojectmentor/view/'); ?>
</div>
	<?php } else if ($projCount > 1) echo 'Too many entries';?>

<!-- PROJECT MENTOR SECTION END -->


<!-- DOMAIN MENTOR SECTION (ROUTE TO CONTROLLER) -->
<?php 	$domCount = Yii::app()->db->createCommand()->select('COUNT(*)')->
												from('application_domain_mentor')->
												where('status="Admin"')->
         										andWhere('user_id=:id', array(':id'=>$user_id))->
												queryScalar();

		if ($domCount == 1) {?>
<div class='well'>
	<?php Yii::app()->runController('/applicationdomainmentor/view'); ?>
</div>
	<?php } else if ($domCount > 1) echo 'Too many entries';?>

<!-- DOMAIN MENTOR SECTION END -->

