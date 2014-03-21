<?php
/* @var $this InvitationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Invitations',
);

$this->menu=array(
	array('label'=>'Create Invitation', 'url'=>array('create')),
	array('label'=>'Manage Invitation', 'url'=>array('admin')),
);
?>

<h1>Invitations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
