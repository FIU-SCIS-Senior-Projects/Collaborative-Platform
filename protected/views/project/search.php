<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<?php
    $users = User::model()->findAllBySql("select fname, lname from user where activated = 1 and disable = 0");
    $data = array();
    $count = 0;
    foreach($users as $u){
        $data[$count] = $u->fname.' '.$u->lname;
        $count++;
    }
?>


<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div id="regbox">
		<?php echo $form->label($model,'propose_by_user_id'); ?>
        <?php echo $form->dropDownList($model, 'propose_by_user_id', $data, array('prompt'=>'')); ?>

        <?php echo $form->label($model,'project_mentor_user_id'); ?>
        <?php echo $form->dropDownList($model, 'project_mentor_user_id', $data, array('prompt'=>'')); ?>

        <?php echo $form->label($model,'start_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Project[start_date]',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        )); ?>
        (yyyy-mm-dd)
		<?php echo $form->label($model,'due_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Project[due_date]',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
        )); ?>
        (yyyy-mm-dd)
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->