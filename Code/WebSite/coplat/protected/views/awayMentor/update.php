<?php
/* @var $this AwayMentorController */
/* @var $model AwayMentor */

$this->breadcrumbs=array(
	'Away Mentors'=>array('index'),
	$model->userID=>array('view','id'=>$model->userID),
	'Update',
);

$this->menu=array(
	array('label'=>'List AwayMentor', 'url'=>array('index')),
	array('label'=>'Create AwayMentor', 'url'=>array('create')),
	array('label'=>'View AwayMentor', 'url'=>array('view', 'id'=>$model->userID)),
	array('label'=>'Manage AwayMentor', 'url'=>array('admin')),
);
?>

<h1>Update AwayMentor <?php echo $model->userID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>