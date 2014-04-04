<?php
/* @var $this UserDomainController */
/* @var $model UserDomain */
/* @var $form CActiveForm */
?>
<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-domain-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div id = "container"; style="margin-top:10px; width: 1000px; border: 1px solid #C9E0ED; border-radius: 5px;">

         <div class ="row"; style = "margin-left: 40px">
            <?php echo $form->labelEx($model,'domain_id'); ?>
            <?php echo $form->dropDownList($model,'domain_id', CHtml::listData(Domain::model()->findAll(), 'id', 'name')); ?>
            <?php echo $form->error($model,'domain_id'); ?>
        </div>

         <div class ="row"; style = "margin-left: 40px">
            <?php $models = User::model()->findAll();  //Needs a getDomainMentor Function

            $data = array();

            foreach ($models as $mod) {
                $data[$mod->id] = $mod->fname .' '. $mod->lname;
            }
            ?>
            <?php echo $form->labelEx($mod, 'Domain Mentor'); ?>
            <?php echo $form->dropDownList($model, 'user_id', $data ,array('prompt' => 'Select')); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div>

        <div class ="row"; style = "margin-left: 40px">
            <?php
            $data = array(0,1,2,3,4,5,6,7,8,9,10);
            ?>
            <?php echo $form->labelEx($model,'rate'); ?>
            <?php echo $form->dropDownList($model, 'rate', $data ,array('prompt' => 'Select')); ?>
            <?php echo $form->error($model,'rate'); ?>
        </div>

         <div class ="row"; style = "margin-left: 40px">
            <?php
                $data = array('No','Yes');
            ?>
            <?php echo $form->labelEx($model,'active'); ?>
            <?php echo $form->dropDownList($model, 'active', $data ,array('prompt' => 'Select')); ?>
            <?php echo $form->error($model,'active'); ?>
        </div>

        <div class ="row"; style = "margin-left: 40px">
            <?php
            $data = array('Select',1,2);
            ?>
            <?php echo $form->labelEx($model,'Tier'); ?>
            <?php echo $form->dropDownList($model, 'tier_team', $data); ?>
            <?php echo $form->error($model,'tier_team'); ?>
        </div>
    </div>

    <br>

    <div id = "operations"; style= "margin-left : 30px">
        <div class="row buttons">
            <?php echo CHtml::submitButton('Save', array("class"=>"btn btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->