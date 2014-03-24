<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<div id = "container"; style="margin-top:10px; width: 800px; border: 1px solid #C9E0ED; border-radius: 5px;">
 	
	<div class ="row"; style = "margin-left: 40px">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('id'=>'comment', 'style'=>'width:500px', 'cols'=>110, 'rows'=>5,
               'width'=>'300px')); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<!-- Not Entered by the user
	<div class ="row"; style = "margin-left: 40px">
		<?php echo $form->labelEx($model,'added_date'); ?>
		<?php echo $form->textField($model,'added_date'); ?>
		<?php echo $form->error($model,'added_date'); ?>
	</div>

	<div class ="row"; style = "margin-left: 40px">
		<?php echo $form->labelEx($model,'ticket_id'); ?>
		<?php echo $form->textField($model,'ticket_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ticket_id'); ?>
	</div>
 	-->
 	
</div>
<br>
	<div id ="row buttons"; style="margin-top:10px; margin-top: 5px;" >
    	<?php echo CHtml::submitButton('Save', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
		
		<?php
				$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'link', 'id'=>'new-box', 'url'=>(array('/ticket/view','id'=>($_GET['id']))),
				'type'=>'primary', 'label'=>'Cancel'));
 ?>

	
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->