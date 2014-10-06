<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-Register-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	

	<?php echo $form->errorSummary($model); ?>
    
	<div id="regbox">
        <?php $this->widget('bootstrap.widgets.TbTabs', array(
		    'tabs'=> $this->getTabs($form, $model)
		)); ?>
        
        <?php echo CHtml::submitButton('Register', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
        
		<?php $this->endWidget(); ?>
	</div>