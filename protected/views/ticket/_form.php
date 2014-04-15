<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="fullcontent">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticket-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php //echo $form->errorSummary($model); ?>

    <div id="regbox">
        <?php echo $form->labelEx($model, 'domain_id'); ?>
        <?php echo $form->dropDownList($model, 'domain_id', CHtml::listData(Domain::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'domain_id'); ?>

        <?php echo $form->labelEx($model, 'subdomain_id'); ?>
        <?php
        echo $form->dropDownList($model, 'subdomain_id', CHtml::listData(Subdomain::model()->findAll(), 'id', 'name'), array('prompt' => 'Select'));
        ?>
        <?php echo $form->error($model, 'subdomain_id'); ?>

        <?php echo $form->labelEx($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject', array('size' => 45, 'style' => 'width:500px', 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'subject'); ?>

        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('id' => 'description', 'style' => 'width:500px', 'cols' => 110, 'rows' => 5, 'width' => '300px')); ?>
        <?php echo $form->error($model, 'description'); ?>

        <?php echo $form->labelEx($model, 'Attach File (optional)'); ?>
        <?php /*echo $form->textField($model,'file',array('size'=>60,'maxlength'=>255)); */ ?>
        <?php echo CHtml::activeFileField($model, 'file'); ?>
        <?php /*echo $form->error($model,'file');*/ ?>

        <?php
        /* If the user if project mentor. He has the option of assign the ticket to another project mentor */
        if (User::isCurrentUserProMentor() || User::isCurrentUserAdmin()) {

            $pmentor = User::model()->findAll("isProMentor=:isProMentor and id!=:id", array(':isProMentor' => 1, ':id'=>
            User::model()->getCurrentUserId()));
            //select * from user where isProMentor = '1' AND username != 'lsanc104'
            $data = array();
            foreach ($pmentor as $mod) {
                $data[$mod->id] = $mod->fname . ' ' . $mod->lname;
            } ?>
            <br/><br/>
            <?php echo $form->labelEx($model, 'Assign to a Project Mentor (optional)'); ?>
            <?php echo $form->dropDownList($model, 'assign_user_id', $data, array('prompt' => 'Select'));?>
            <?php echo $form->error($model, 'assign_user_id');?>
        <?php } ?>

        <?php
        /* If the user if project mentor. He has the option of assign the ticket to another project mentor */
        if (User::isCurrentUserMentee()) {

            $mentee = Mentee::model()->findByPk(User::getCurrentUserId());
            $projectmentor = ProjectmentorProject::model()->findByPk($mentee->projectmentor_project_id);

            $mentor = User::model()->find("id=:id", array(':id'=>$projectmentor->project_mentor_user_id));


            $data = array();
           // foreach ($mentor as $mod) {
                $data[$mentor->id] = $mentor->fname . ' ' . $mentor->lname;
            //}?>
            <br/><br/>
            <?php echo $form->labelEx($model, 'Assign to a Mentor (optional)'); ?>
            <?php echo $form->dropDownList($model, 'assign_user_id', $data, array('prompt' => 'Select'));?>


            <?php echo $form->error($model, 'assign_user_id');?>
        <?php }?>




        <br/><br/>
        <?php echo CHtml::submitButton('Submit', array("class" => "btn btn-primary")); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
