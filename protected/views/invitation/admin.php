<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Manage Invitations',
);
?>

<h2>Manage Invitations</h2>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'invitation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
        'date',
        'name',
		'email',
        'administrator_user_id',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
