<?php
/* @var $this InvitationController */
/* @var $model Invitation */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invitation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div id="regbox">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>256,'maxlength'=>256)); ?>
        <?php echo $form->error($model,'name'); ?>
        <br/>

        <?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
        <br/>

		<?php echo $form->checkBox($model,'administrator',array('style'=>'float:left')); ?>
        <p style="float:left; margin-left:5px">System Administrator</p><br/><br/>
		<?php echo $form->error($model,'administrator'); ?>


        <?php echo $form->checkBox($model,'mentee',array('style'=>'float:left')); ?>
        <p style="float:left; margin-left:5px">Mentee</p><br/><br/>
        <?php echo $form->error($model,'mentee'); ?>

        <?php echo CHtml::submitButton('Send', array("class"=>"btn btn-primary")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->