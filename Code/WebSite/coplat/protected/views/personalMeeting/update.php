<?php
/* @var $this PersonalMeetingController */
/* @var $model PersonalMeeting */

$this->breadcrumbs=array(
	'Personal Meetings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PersonalMeeting', 'url'=>array('index')),
	array('label'=>'Create PersonalMeeting', 'url'=>array('create')),
	array('label'=>'View PersonalMeeting', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PersonalMeeting', 'url'=>array('admin')),
);
?>

<h1>Update PersonalMeeting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>