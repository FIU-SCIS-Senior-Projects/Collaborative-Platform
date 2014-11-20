<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>


<?php
$users = User::model()->findAllBySql("select id, fname, lname from user where activated = 1 and disable = 0 order by lname");
$data = array();

foreach($users as $u){
    $data[$u->id] = $u->fname.' '.$u->lname;
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
        <br/>
		<?php echo CHtml::submitButton('Search', array("class"=>"btn btn-primary")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->