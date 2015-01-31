<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Manage Invitations'=>array('admin'),
	$model->name,

);

?>

<h2>Resend Invitation to <?php echo $model->name; ?></h2>

<?php echo $this->renderPartial('change', array('model'=>$model)); ?>