<?php
/* @var $form CActiveForm */

$command = Yii::app()->db->createCommand("select u.id, CONCAT(u.fname, ' ', u.lname) as fullname from user u where isMentee = 1");
$rows = $command->queryAll();$rows = $command->queryAll();

$listdata = CHtml::listData($rows,'id', 'fullname');

?>

<div class="form centerTxt">

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'application-personal-mentor-pick-form',
		'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row"> 
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->dropDownList($model, 'user_id', $listdata , array('prompt'=>'Select Mentee')); ?>
        <?php echo $form->error($model,'user_id'); ?>
    </div>  

    <div class="row buttons"> 
     <?php echo CHtml::submitButton('Propose New Personal Mentee', array("class"=>"btn btn-medium btn-primary",'id'=>'submit')/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
     
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- form -->