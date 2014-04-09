<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>


<div class="form" style="width: 750px" >

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticket-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <!-- Not inputed from User
	<div class="row">
		<?php echo $form->labelEx($model, 'creator_user_id'); ?>
		<?php echo $form->textField($model, 'creator_user_id', array('size' => 11, 'maxlength' => 11)); ?>
		<?php echo $form->error($model, 'creator_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->textField($model, 'status', array('size' => 45, 'maxlength' => 45)); ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'created_date'); ?>
		<?php echo $form->textField($model, 'created_date'); ?>
		<?php echo $form->error($model, 'created_date'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model, 'assign_user_id'); ?>
		<?php echo $form->textField($model, 'assign_user_id', array('size' => 11, 'maxlength' => 11)); ?>
		<?php echo $form->error($model, 'assign_user_id'); ?>
	</div>
    End -->

    <div id="container"
    ; style="margin-top:10px; width: 600px; border: 1px solid #C9E0ED; border-radius: 5px;">
        <br>
        <div class="row"; style = "margin-left: 40px">
            <?php echo $form->labelEx($model, 'domain_id'); ?>
            <?php echo $form->dropDownList($model, 'domain_id', CHtml::listData(Domain::model()->findAll(), 'id', 'name')); ?>
            <?php echo $form->error($model, 'domain_id'); ?>
        </div>

        <div class="row"
        ; style = "margin-left: 40px">
            <?php echo $form->labelEx($model, 'subject'); ?>
            <?php echo $form->textField($model, 'subject', array('size' => 45, 'style' => 'width:500px', 'maxlength' => 45)); ?>
            <?php echo $form->error($model, 'subject'); ?>
        </div>

        <div class="row"; style = "margin-left: 40px">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textArea($model, 'description', array('id' => 'description', 'style' => 'width:500px', 'cols' => 110, 'rows' => 5, 'width' => '300px')); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>


        <!-->
        <div class="row"; style = "margin-left: 40px">
            <?php echo $form->labelEx($model, 'Attach File'); ?>
            <?php /*echo $form->textField($model,'file',array('size'=>60,'maxlength'=>255)); */ ?>
            <?php echo CHtml::activeFileField($model, 'file'); ?>
            <?php /*echo $form->error($model,'file');*/ ?>
            <!-- Attachment: <INPUT TYPE="file" NAME="attachedfile" MAXLENGTH=255 ALLOW="text/*" > -->

        </div>
        <br>


    </div>

<br>

<div class = "span2">
    <?php echo CHtml::submitButton('Save', array("class" => "btn btn-primary") /*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
    &nbsp;&nbsp;
    <?php /*$this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'link', 'id' => 'new-box', 'url' => (array('/ticket/view', 'id' => $model->id)), 'type' => 'primary',
        'label' => 'Cancel',));*/
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'link', 'url' => '#',
        'htmlOptions' => array(
            'id' => 'my-back',
        ),
        'type' => 'primary', 'label' => 'Back'));
    ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<script>
    $('#my-back').on('click', function(){
        window.history.back();

        return false;
    });
</script>