<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

        <?php

            echo $form->dropDownList($model, 'firstField', array('Project Mentor', 'Personal Mentor',
            		'Domain Mentor', 'Mentee'), array('style' => 'float:left'));

            echo $form->dropDownList($model, 'criteria', array('Exactly', 'Greater Than',
            		'Less Than'), array('style' => 'float:left'));

			echo $form->textField($model, 'quantity', array('hint'=>'', 'style' => 'float:left'));

            echo $form->dropDownList($model, 'disable', array('Enabled', 'Disabled'), array('style' => 'float:left'));


        ?>

        <?php echo CHtml::submitButton('Search', array("class" => "btn btn-primary")); ?>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->