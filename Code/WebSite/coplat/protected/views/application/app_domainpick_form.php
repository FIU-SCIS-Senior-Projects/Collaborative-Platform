<?php
/* @var $form CActiveForm */
?>
<div class="form centerTxt">
<?php

//$command= Yii::app()->db->createCommand("select u.id, CONCAT(u.fname, ' ', u.lname) as fullname from user u, personal_mentor_mentees s where u.isMentee = 1 AND u.id !=s.user_id");
$command = Yii::app()->db->createCommand("select u.id, name from domain u");
$rows = $command->queryAll();

$listdata = CHtml::listData($rows,'id', 'name');

?>


<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'application-domain-mentor-pick-form',
		'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row"> 
        <?php echo $form->labelEx($model,'domain_id'); ?>
        <?php echo $form->dropDownList($model, 'domain_id', $listdata , array('prompt'=>'Select Domain')); ?>
                <?php echo $form->error($model,'domain_id'); ?>
    </div> 

    <div class="row"> 
    	<?php echo $form->labelEx($model,'proficiency'); ?>
		<?php echo $form->dropDownList($model,'proficiency', array(1,2,3,4,5,6,7,8,9,10), array()); ?>
		<?php echo $form->error($model,'proficiency'); ?>

    </div> 

    <div class="row buttons"> 
   		 <?php echo CHtml::submitButton('Propose New Domain', array("class"=>"btn btn-medium btn-primary",'id'=>'submit')/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- form -->