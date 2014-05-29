<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>


<?php
$users = User::model()->findAllBySql("select id, fname, lname from user where activated = 1 and disable = 0");
$data = array();

foreach($users as $u){
    $data[$u->id] = $u->fname.' '.$u->lname;
}
?>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'project-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>


    <div id="regbox">

        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'title'); ?>


        <?php echo $form->labelEx($model,'propose_by_user_id'); ?>
        <?php echo $form->dropDownList($model, 'propose_by_user_id', $data); ?>
        <?php echo $form->error($model,'propose_by_user_id'); ?>

        <?php echo $form->labelEx($model,'project_mentor_user_id'); ?>
        <?php echo $form->dropDownList($model, 'project_mentor_user_id', $data, array('prompt'=>'Optional')); ?>
        <?php echo $form->error($model,'project_mentor_user_id'); ?>

        <?php echo $form->labelEx($model,'start_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Project[start_date]',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        )); ?>
        (yyyy-mm-dd)
        <?php echo $form->error($model,'start_date'); ?>

        <?php echo $form->labelEx($model,'due_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Project[due_date]',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        )); ?>
        (yyyy-mm-dd)
        <?php echo $form->error($model,'due_date'); ?>
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('id'=>'theDescription', 'style'=>'width:631px', 'cols'=>100, 'rows'=>10,
            'width'=>'691px','size'=>500,'maxlength'=>5000)); ?>
        <?php echo $form->error($model,'description'); ?>

        <br/>
        <?php echo CHtml::submitButton('Save',  array("class"=>"btn btn-primary")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->