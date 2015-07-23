<?php
/**
 * Created by PhpStorm.
 * User: Mandy
 * Date: 7/13/15
 * Time: 7:24 PM
 */
?>

<?php
/* @var $this VideoConferenceController */
/* @var $model VideoConference */

$this->breadcrumbs=array(
    'Video Conferences'=>array('index'),
   // 'View Deleted',
);

$this->menu=array(
    array('label'=>'List VideoConference', 'url'=>array('index')),
    array('label'=>'Create VideoConference', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#video-conference-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Deleted Video Conferences</h2>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'video-conference-grid',
    'dataProvider'=>$model->searchDeleted(User::getCurrentUserId()),
    'filter'=>$model,
    'columns'=>array(
//        'id::Video Conference Id',
        'subject',
        array(
            'name'  => 'moderatorName',
            'value' => '($data->getVCModerator())',
            'header'=> 'Moderator',
            'filter'=> CHtml::activeTextField($model, 'moderatorName'),
        ),
      /// array('name'=>'moderatorName','value'=>'$data->getVCModerator()'),
        //'user.fname',
        //'moderator_id',
        'scheduled_on',
        'scheduled_for',
        'notes',
        'status',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>

