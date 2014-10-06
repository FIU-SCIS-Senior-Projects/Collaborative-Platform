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

    <div >

        <?php
            //echo $form->labelEx($model, 'men_role', array('style' => 'font-weight: bold; margin-bottom:.5cm'));

            echo $form->checkBox($model, 'isProMentor', array('style' => 'float:left'));
            echo $form->label($model, 'isProMentor', array('style' => 'margin-left:.5cm'));


            echo $form->checkBox($model, 'isPerMentor', array('style' => 'float:left'));
            echo $form->label($model, 'isPerMentor', array('style' => 'margin-left:.5cm'));

            echo $form->checkBox($model, 'isDomMentor', array('style' => 'float:left'));
            echo $form->label($model, 'isDomMentor', array('style' => 'margin-left:.5cm'));

            echo $form->checkBox($model, 'isMentee', array('style' => 'float:left'));
            echo $form->label($model, 'isMentee', array('style' => 'margin-left:.5cm'));


            echo $form->checkBox($model, 'disable', array('style' => 'float:left'));
            echo $form->label($model, 'disable', array('style' => 'margin-left:.5cm'));

            //echo $form->checkBox($model, 'activated', array('style' => 'float:left'));
            //echo $form->label($model, 'activated', array('style' => 'margin-left:.5cm'));

            //echo $form->dropDownList($model, 'disable', array('Enabled', 'Disabled'), array('style' => 'float:left'));



        /**
         * echo $form->labelEx($model,'vjf_role');?>
         * <?php
         * echo $form->checkBox($model,'isEmployer',array('style'=>'float:left'));
         * ?>
         * <p style="float:left; margin-left:5px">Employer</p></br></br>
         *
         * <?php
         * echo $form->checkBox($model,'isStudent',array('style'=>'float:left'));
         * ?>
         * <p style="float:left; margin-left:5px">Student</p></br></br>
         *
         *
         * <?php
         * //echo $form->labelEx($model,'rmj_role');
         * //echo $form->checkBox($model,'isJudge',array('style'=>'float:left'));
         * ?>
         * <p style="float:left; margin-left:5px">Judge</p></br></br>
         *
         * <?php
         * echo $form->checkBox($model,'isStudent',array('style'=>'float:left'));
         * ?>
         *
         * <p style="float:left; margin-left:5px">Student</p><label>&nbsp;&nbsp;&nbsp;</label>
         **/
        ?>

        <?php echo CHtml::submitButton('Search', array("class" => "btn btn-primary")); ?>
    </div>
    <!-- regbox -->

    <?php $this->endWidget(); ?>
    <div style="clear:both"></div>
    </br>

</div><!-- search-form -->