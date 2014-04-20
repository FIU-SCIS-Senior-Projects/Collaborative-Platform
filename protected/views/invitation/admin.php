<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Manage Invitations',
);


/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invitation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h2>Manage Invitations</h2>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'invitation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
        'date',
		'email',
        'administrator_user_id',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
