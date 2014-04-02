<?php
/* @var $this DomainController */
/* @var $model Domain */
/* @var $form CActiveForm */
?>
<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />

<div class="wide form">
	<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

	<div id="regbox">
    	<!--<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
		-->
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		</br>
		<?php echo CHtml::submitButton('Search',array("class"=>"btn btn-primary")); ?>		
	</div>    

	<?php $this->endWidget(); ?>
	<div style="clear:both"></div>
	</br>

</div><!-- search-form -->