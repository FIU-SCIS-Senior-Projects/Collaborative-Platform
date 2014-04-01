<?php
/* @var $this UserDomainController */
/* @var $model UserDomain */
/* @var $form CActiveForm */
?>
<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-domain-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div id = "container"; style="margin-top:10px; width: 1000px; border: 1px solid #C9E0ED; border-radius: 5px;">

         <div class ="row"; style = "margin-left: 40px">
            <?php echo $form->labelEx($model,'domain_id'); ?>
            <?php echo $form->dropDownList($model,'domain_id', CHtml::listData(Domain::model()->findAll(), 'id', 'name')); ?>
            <?php echo $form->error($model,'domain_id'); ?>
        </div>

         <div class ="row"; style = "margin-left: 40px">

            <?php echo $form->labelEx($model,'Domain Mentor'); ?>
            <?php echo $form->dropDownList($model,'user_id', CHtml::listData(User::model()->findAll(array('order' => 'fname ASC')), 'id', 'fname','lname')); ?>
            <?php echo $form->error($model,'user_id'); ?>

        </div>

        <div class ="row"; style = "margin-left: 40px">
            <?php echo $form->labelEx($model,'rate'); ?>
            <?php echo $form->textField($model,'rate'); ?>
            <?php echo $form->error($model,'rate'); ?>
        </div>

         <div class ="row"; style = "margin-left: 40px">
            <?php echo $form->labelEx($model,'active'); ?>
            <?php echo $form->textField($model,'active'); ?>
            <?php echo $form->error($model,'active'); ?>
        </div>

        <div class ="row"; style = "margin-left: 40px">
            <?php echo $form->labelEx($model,'tier_team'); ?>
            <?php echo $form->textField($model,'tier_team'); ?>
            <?php echo $form->error($model,'tier_team'); ?>
        </div>
    </div>

    <br>

    <div id = "operations"; style= "margin-left : 30px">
        <div class="row buttons">
            <?php echo CHtml::submitButton('Save', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->