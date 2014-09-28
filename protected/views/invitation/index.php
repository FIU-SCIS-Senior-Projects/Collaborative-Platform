<?php
/* @var $this InvitationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Invitations',
);

?>

<h1>Invitations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
