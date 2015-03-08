<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */

//echo Yii::app()->user->getId();


$this->breadcrumbs = array(
    'Video Conferences' => array('index'),
    $model->id,
);



$this->menu = array(
    array('label' => 'List VideoConference', 'url' => array('index')),
    array('label' => 'Create VideoConference', 'url' => array('create')),
    array('label' => 'Update VideoConference', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete VideoConference', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage VideoConference', 'url' => array('admin')),
);
?>

<h1>View VideoConference #<?php echo $model->id; ?></h1>




<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'moderator_id',
		'scheduled_on',
		'scheduled_for',
		'notes',
	),

)); ?>

<a href="./join/<?php echo $model->id?>">Join Now</a>


