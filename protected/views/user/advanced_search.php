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
        	//$dataRoleVal = array(0,1,2,3);
        
            $dataRole = array('Project Mentor', 'Personal Mentor', 'Domain Mentor', 'Mentee');
            echo $form->dropDownList($model, 'firstField', array(0=>'Project Mentor', 1=>'Personal Mentor',
                2=>'Domain Mentor', 3=>'Mentee'), array('style' => ''));

            $crit = array('Exactly'=>'Exactly', 'Greater'=>'Greater Than','Less'=>'Less Than');
            echo $form->dropDownList($model, 'criteria', $crit, array('style' => ''));

			echo $form->textField($model, 'quantity', array('size'=>'5', 'hint'=>'', 'style' => ''));

            $data = array('Enabled', 'Disabled');
            echo $form->dropDownList($model, 'disable', $data, array('style' => ''));

        ?>

        <?php echo CHtml::submitButton('Search', array("class" => "btn btn-primary")); ?>

    <?php $this->endWidget(); ?>
    <!-- search-form -->
</div>