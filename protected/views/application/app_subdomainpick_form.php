<?php
/* @var $form CActiveForm */

$command = Yii::app()->db->createCommand("select u.id, name from subdomain u");
$rows = $command->queryAll();
$listdata = CHtml::listData($rows,'id', 'name');

?>

<div class="form centerTxt"> 

<?php $form=$this->beginWidget('CActiveForm', array( 
    'id'=>'application-subdomain-mentor-pick-form', 
    'enableAjaxValidation'=>false, 
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row"> 
        <?php echo $form->labelEx($model,'subdomain_id'); ?>
        <?php echo $form->dropDownList($model, 'subdomain_id', $listdata , array('prompt'=>'Select Subdomain')); ?>
                <?php echo $form->error($model,'subdomain_id'); ?>
    </div>

    <div class="row"> 
        <?php echo $form->labelEx($model,'proficiency'); ?>
		<?php echo $form->dropDownList($model,'proficiency', array(1,2,3,4,5,6,7,8,9,10), array()); ?>
		<?php echo $form->error($model,'proficiency'); ?>
    </div>

    <div class="row buttons"> 
       		 <?php echo CHtml::submitButton('Propose New Subdomain', array("class"=>"btn btn-medium btn-primary", 'id'=>'submit')/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
    
        <?php // echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- form -->