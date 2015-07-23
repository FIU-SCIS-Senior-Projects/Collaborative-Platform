<?php
/* @var $this AwayMentorController */
/* @var $model AwayMentor */

$this->breadcrumbs=array(
	'Away Mentors'=>array('index'),
	$model->userID,
);

$this->menu=array(
	array('label'=>'List AwayMentor', 'url'=>array('index')),
	array('label'=>'Create AwayMentor', 'url'=>array('create')),
	array('label'=>'Update AwayMentor', 'url'=>array('update', 'id'=>$model->userID)),
	array('label'=>'Delete AwayMentor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->userID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AwayMentor', 'url'=>array('admin')),
);
?>

<h1>View AwayMentor #<?php echo $model->userID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'userID',
		'tiStamp',
	),
)); ?>
