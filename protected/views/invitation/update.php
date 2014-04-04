<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Invitations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Invitation', 'url'=>array('index')),
	array('label'=>'Create Invitation', 'url'=>array('create')),
	array('label'=>'View Invitation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Invitation', 'url'=>array('admin')),
);
?>

<h1>Update Invitation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>