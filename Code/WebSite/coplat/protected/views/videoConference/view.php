<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */


$user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
$ismoderator  = $user->id == $model->moderator_id;



$this->breadcrumbs = array(
'Video Conferences' => array('index'),
$model->id,
);

//array('label' => 'Update VideoConference', 'url' => array('update', 'id' => $model->id)),

$this->menu = array(
array('label' => 'List VideoConference', 'url' => array('index')),
array('label' => 'Create VideoConference', 'url' => array('create')),
array('label' => 'Delete VideoConference', 'url' => '#', 'visible' => $ismoderator,'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
array('label' => 'Manage VideoConference', 'url' => array('admin')),
);
?>

<style>
.error-message {
    background-color: #f2dede;
    border-radius: 3px;
    padding:10px;
}

</style>

<h1>Subject: <?php echo $model->subject; ?></h1>



<?php if (Yii::app()->user->hasFlash('invitation-error')): ?>
<h3>There were some problems with your invitations: </h3>
<div class="error-message">
    <?php echo Yii::app()->user->getFlash('invitation-error'); ?>
</div>
<?php endif; ?>



<?php $this->widget('zii.widgets.CDetailView', array(
'data' => $model,
'attributes' => array(
    'scheduled_on',
    'scheduled_for',
    'notes',
),

)); ?>

<!--<a href="https://cp-dev.cis.fiu.edu/coplat/index.php/videoConference/join/<?php echo $model->id ?>">Join Now</a>-->

<?php
echo CHtml::link('Join Now', $this->createAbsoluteUrl('videoConference/join/' . $model->id ,array(),'https'));
?>