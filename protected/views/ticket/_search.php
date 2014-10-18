<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
/* @var $data1 creatorUser */
/* @var $data2 assignedUser */
/* @var $data3 domainName */
/* @var $data4 subDomainName */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<!--  
	<div class="row">
		<?php //echo $form->label($model,'id'); ?>
		<?php //echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>
		-->

	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Ticket[created_date]',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        )); ?>	
        (yyyy-mm-dd)
    </div>
		
	<div class="row">
		<?php echo $form->label($model,'creator_user_id'); ?>
		<?php echo $form->dropDownList($model,'creator_user_id', array(''=>'Show All') + $data1, array()); ?>
	</div>

	<div class="row">
		<?php $status = array(''=>'Show All', 'Pending'=>'Pending', 'Close'=>'Closed', 'Reject'=>'Rejected')?>
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $status, array()); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'assigned_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Ticket[assigned_date]',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        )); ?>	
        (yyyy-mm-dd)
	</div>

	<!--<div class="row">
		<?php /*echo $form->label($model,'subject'); */?>
		<?php /*echo $form->textField($model,'subject',array('size'=>45,'maxlength'=>45)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'description'); */?>
		<?php /*echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); */?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'assign_user_id'); ?>
		<?php echo $form->dropDownList($model,'assign_user_id', array(''=>'Show All') + $data2, array()); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'domain_id'); ?>
		<?php echo $form->dropDownList($model,'domain_id', array(''=>'Show All') + $data3, array()); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subdomain_id'); ?>
		<?php echo $form->dropDownList($model,'subdomain_id', array(''=>'Show All') + $data4, array()); ?>
	</div>

	<!--  
	<div class="row">
		<?php //echo $form->label($model,'file'); ?>
		<?php //echo $form->textField($model,'file',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	-->
    <div class="row">
        <?php echo $form->label($model,'priority_id'); ?>
        <?php 
        	$prio = array('' => 'Show All', 1=>'High', 2=>'Medium', 3=>'Low');
        	echo $form->dropDownList($model,'priority_id', $prio, array()); ?>
    </div>
    
    	<div class="row">
		<?php echo $form->label($model,'closed_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Ticket[closed_date]',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        )); ?>	
        (yyyy-mm-dd)
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->