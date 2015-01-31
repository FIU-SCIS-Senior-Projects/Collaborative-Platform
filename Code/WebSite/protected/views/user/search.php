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

        if ($model->isMentee === '0') {
            $model->isMentee = '';
        }

        if ($model->isDomMentor === '0')
            $model->isDomMentor = '';

        if ($model->isPerMentor === '0')
            $model->isPerMentor = '';

        if ($model->isProMentor === '0')
            $model->isProMentor = '';

        if ($model->disable === '0')
            $model->disable = '';

        ?>

        <?php echo CHtml::submitButton('Search', array("class" => "btn btn-primary")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->

