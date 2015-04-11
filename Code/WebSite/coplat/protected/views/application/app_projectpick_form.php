<?php
/* @var $form CActiveForm */ 

$command = Yii::app()->db->createCommand("select u.id, title from project u");
$rows = $command->queryAll();
$listdata = CHtml::listData($rows,'id', 'title');

?> 

<div class="form centerTxt"> 

<?php $form=$this->beginWidget('CActiveForm', array( 
    'id'=>'application-project-mentor-pick-form', 
    'enableAjaxValidation'=>false, 
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row"> 
        <?php echo $form->labelEx($model,'project_id'); ?>
        <?php echo $form->dropDownList($model, 'project_id', $listdata , array('prompt'=>'Select Subdomain')); ?>
        <?php echo $form->error($model,'project_id'); ?>
    </div> 

    <div class="row buttons"> 
       		 <?php echo CHtml::submitButton('Propose New Project', array("class"=>"btn btn-medium btn-primary",'id'=>'submit')/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
    
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- form -->