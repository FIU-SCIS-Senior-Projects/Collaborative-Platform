<?php
/* @var $this DomainMentorController */
/* @var $model DomainMentor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domain-mentor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
       <?php $models = User::model()->findAll();
             $data = array();

            foreach ($models as $mod) {
                $data[$mod->id] = $mod->fname . ' '. $mod->lname;
            }
       ?>
       <?php echo $form->labelEx($mod, 'Domain Mentor'); ?>
       <?php echo $form->dropDownList($model, 'user_id', $data ,array('prompt' => 'Select')); ?>
       <?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_tickets'); ?>
		<?php echo $form->textField($model,'max_tickets'); ?>
		<?php echo $form->error($model,'max_tickets'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->