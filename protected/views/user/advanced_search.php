<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        //'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    	'type' => 'horizontal',
    )); ?>

        <?php
        
            echo $form->dropDownListRow($model, 'firstField', array('Project Mentor', 'Personal Mentor', 
            		'Domain Mentor', 'Mentee'), array('style' => 'float:left'));
                        
            echo $form->dropDownListRow($model, 'criteria', array('Exactly', 'Greater Than',
            		'Less Than'), array('style' => 'float:left'));
            
			echo $form->textFieldRow($model, 'quantity', array('hint'=>''));
			
            echo $form->dropDownListRow($model, 'disable', array('Enabled', 'Disabled'), array('style' => 'float:left'));

        
        ?>

        <?php echo CHtml::submitButton('Search', array("class" => "btn btn-primary")); ?>
    <!-- regbox -->

    <?php $this->endWidget(); ?>
    <div style="clear:both"></div>
    </br>

</div><!-- search-form -->