<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="regbox">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	
    	<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	
    	<?php echo $form->label($model,'domain_id'); ?>
		<?php echo $form->dropDownList($model,'domain', CHtml::listData(Domain::model()->findAll(), 'id', 'name')); ?> 
		</br>
    	<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-primary')); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->