<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Invitations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Invitation', 'url'=>array('index')),
	array('label'=>'Create Invitation', 'url'=>array('create')),
	array('label'=>'Update Invitation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Invitation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Invitation', 'url'=>array('admin')),
);
?>

<h1>View Invitation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'administrator_user_id',
		'date',
		'administrator',
		'mentor',
		'mentee',
		'employer',
		'judge',
	),
)); ?>
