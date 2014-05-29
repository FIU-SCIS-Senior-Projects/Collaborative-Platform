<?php
/* @var $this SubdomainController */
/* @var $model Subdomain */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div id="regbox">
		<?php echo $form->label($model,'domain_id'); ?>
        <?php echo $form->dropDownList($model, 'domain_id', CHtml::listData(Domain::model()->findAll(), 'id', 'name'), array('prompt' => 'Select')); ?>
        <br/>

		<?php echo CHtml::submitButton('Search', array("class"=>"btn btn-primary")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->