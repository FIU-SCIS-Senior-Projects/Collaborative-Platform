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

<a href="./join/<?php echo $model->id ?>">Join Now</a>


