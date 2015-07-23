<?php
/* @var $this AwayMentorController */
/* @var $model AwayMentor */

$this->breadcrumbs=array(
	'Away Mentors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AwayMentor', 'url'=>array('index')),
	array('label'=>'Manage AwayMentor', 'url'=>array('admin')),
);
?>

<h1>Create AwayMentor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php if (Yii::app()->user->hasFlash('invitation-error')): ?>
    <h3>There was an error: </h3>
    <div style="margin-top:20px;" class="error-message">
        <?php echo Yii::app()->user->getFlash('invitation-error'); ?>
    </div>
<?php endif; ?>
