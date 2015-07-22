<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */

$this->breadcrumbs=array(
	'Video Conferences'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VideoConference', 'url'=>array('index')),
//	array('label'=>'Manage VideoConference', 'url'=>array('admin')),
);
?>

<h1>Create VideoConference</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>