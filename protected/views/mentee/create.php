<?php
/* @var $this MenteeController */
/* @var $model Mentee */

$this->breadcrumbs=array(
	'Mentees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mentee', 'url'=>array('index')),
	array('label'=>'Manage Mentee', 'url'=>array('admin')),
);
?>

<h1>Create Mentee</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>