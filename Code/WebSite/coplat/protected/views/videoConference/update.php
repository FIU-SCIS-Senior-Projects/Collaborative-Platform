<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */

$this->breadcrumbs=array(
	'Video Conferences'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VideoConference', 'url'=>array('index')),
	array('label'=>'Create VideoConference', 'url'=>array('create')),
	array('label'=>'View VideoConference', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage VideoConference', 'url'=>array('admin')),
);
?>

<h1>Update VideoConference <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>