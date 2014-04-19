<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Invitations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h2>Update Invitation <?php echo $model->id; ?></h2>

<?php echo $this->renderPartial('change', array('model'=>$model)); ?>