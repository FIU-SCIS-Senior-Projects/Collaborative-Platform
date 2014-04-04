<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Invitations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Invitation', 'url'=>array('index')),
	array('label'=>'Manage Invitation', 'url'=>array('admin')),
);
?>

<h1>Create Invitation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>