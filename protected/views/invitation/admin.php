<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Manage Invitations',
);
?>

<h2>Manage Invitations</h2>

<a href=../invitation/create>
<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'label'=>'Invite',
		'icon'=>'plus white',
		'size'=>'small',
		'type'=> 'success',
		//'htmlOptions'=>array('class'=>'pull-right')
		//'url'=>'user/create',
		// button for ADD NEW DOMAIN/SUBDOMAIN
		// FIX HREF
));?>
</a>


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
