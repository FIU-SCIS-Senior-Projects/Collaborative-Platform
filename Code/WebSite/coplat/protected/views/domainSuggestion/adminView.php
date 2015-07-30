<?php
/* @var $this DomainSuggestionController */
/* @var $model DomainSuggestion */
/* @var $form CActiveForm */
if(User::isCurrentUserAdmin()) {
    $this->menu = array(
        array('label' => 'Manage DomainSuggestion', 'url' => array('admin')),
    );
}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domain-suggestion-adminView-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo "Name: " . $model->name."\n";?>
    </div>
    <br/>
    <div class="row">
        <?php echo "Select a Domain*";?>
    </div>
    <div class="row">
        <?php

        $list = array();
        $count = 0;
        $domains = Domain::model()->findAll();
        foreach($domains as $dom)
        {
            $list[$dom->id]=$dom->name;
            $count=$dom->id;
        }
        $count++;
        $list[$count] = 'New Domain';
        echo $form->dropDownList($model, 'Domain', $list, array('prompt' => 'Select'));

        ?>
    </div>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model, 'description', array('id' => 'description', 'style' => 'width:500px', 'cols' => 110, 'rows' => 5, 'width' => '300px')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Accept',array('name' => 'button1'));?>
         <? echo '&nbsp;&nbsp;&nbsp;'; ?>
        <?php echo CHtml::submitButton('Reject',array('name' => 'button2'));?>
	</div>
    <br/><br/><br/>
    * Select a domain that this new domain will be a sub-domain of, if this new domain is not a sub-domain select new domain.
<?php $this->endWidget(); ?>

</div><!-- form -->