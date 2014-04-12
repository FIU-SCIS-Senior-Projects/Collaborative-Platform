<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="fullcontent">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

    <div id="regbox">
        <?php echo $form->labelEx($model,'domain_id'); ?>
        <?php echo $form->dropDownList($model, 'domain_id', CHtml::listData(Domain::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'domain_id'); ?>

		<?php echo $form->labelEx($model,'subdomain_id'); ?>
		<?php


        echo $form->dropDownList($model, 'subdomain_id', CHtml::listData(Subdomain::model()->findAll(), 'id', 'name'),array('prompt' => 'Select'));
        ?>


        <?php echo $form->error($model,'subdomain_id'); ?>
	    <?php echo $form->labelEx($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject', array('size' => 45, 'style' => 'width:500px', 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'subject'); ?>

        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('id' => 'description', 'style' => 'width:500px', 'cols' => 110, 'rows' => 5, 'width' => '300px')); ?>
        <?php echo $form->error($model, 'description'); ?>

        <?php echo $form->labelEx($model, 'Attach File'); ?>
        <?php /*echo $form->textField($model,'file',array('size'=>60,'maxlength'=>255)); */ ?>
        <?php echo CHtml::activeFileField($model, 'file'); ?>
        <?php /*echo $form->error($model,'file');*/ ?>
        <br/><br/>
        <?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-primary")); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->
