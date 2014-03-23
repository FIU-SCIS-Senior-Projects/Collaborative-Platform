<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
/* @var $model Topic */
?>

<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<!-- Not needed
	<div class="center">
		<?php echo $form->labelEx($model,'creator_user_id'); ?>
		<?php echo $form->textField($model,'creator_user_id',array('size'=>50, 'style'=>'width:50px','maxlength'=>11)); ?>
		<?php echo $form->error($model,'creator_user_id'); ?>
	</div>
	 <div class="center">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date',array('style'=>'width:20px')); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>
	<div class="center">
		<?php echo $form->labelEx($model,'last_updated'); ?>
		<?php echo $form->textField($model,'last_updated',array('style'=>'width:20px')); ?>
		<?php echo $form->error($model,'last_updated'); ?>
	</div>
	<div class="center">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>45,'style'=>'width:20px','maxlength'=>45)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	<div class="center">
		<?php echo $form->labelEx($model,'answer'); ?>
		<?php echo $form->textField($model,'answer',array('size'=>60,'style'=>'width:20px', 'maxlength'=>500)); ?>
		<?php echo $form->error($model,'answer'); ?>
	</div>
	<div class="center">
		<?php echo $form->labelEx($model,'assign_user_id'); ?>
		<?php echo $form->textField($model,'assign_user_id',array('size'=>11,'style'=>'width:20px', 'maxlength'=>11)); ?>
		<?php echo $form->error($model,'assign_user_id'); ?>
	</div>
	
	End --> 

	<div id = "container"; style="margin-top:10px; width: 1000px; border: 1px solid #C9E0ED; border-radius: 5px;">


		<div class ="row"; style = "margin-left: 40px">
			<?php echo $form->labelEx($model,'subject'); ?>
			<?php echo $form->textField($model,'subject',array('size'=>45,'style'=>'width:500px', 'maxlength'=>45)); ?>
			<?php echo $form->error($model,'subject'); ?>
			</div>

			<div class ="row"; style = "margin-left: 40px">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model,'description',array('id'=>'description', 'style'=>'width:500px', 'cols'=>110, 'rows'=>5,
                    'width'=>'300px')); ?>
			<?php echo $form->error($model,'description'); ?>
			</div>

			<div class ="row"; style = "margin-left: 40px">
			<?php echo $form->labelEx($model,'topic_id'); ?>
			<?php echo $form->textField($model,'topic_id',array('size'=>11,'style'=>'width:100px','maxlength'=>11)); ?>
			<?php echo $form->error($model,'topic_id'); ?>
			</div>
			
	</div>

	<br>
	<div id = "operations"; style= "margin-left : 30px">
		<div class="row buttons">
    	 <?php echo CHtml::submitButton('Create', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
 		
	     <?php $this->widget('bootstrap.widgets.TbButton', array(
           		 'buttonType'=>'link', 'id'=>'new-box', 'url'=>'/coplat/index.php/ticket/index', 'type'=>'primary',
            	 'label'=>'Cancel', )); ?>		
 		 	

	     </div>
	</div>
	
	
<?php $this->endWidget(); ?>

</div><!-- form -->
	     
	     
	     
	     
	     