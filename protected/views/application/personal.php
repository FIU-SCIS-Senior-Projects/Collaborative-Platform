<?php
/* 
 * @var $this ApplicationController 
 * @var $model Application
 * @var $search User
 * */
?>

<h1 class="centerTxt">Personal Mentor</h1>
<br>
<p class="centerTxt">From here you may select students to mentor. You can hand pick students from the list in the You Pick column. You can also provide criteria for automatic student selection.</p>
<br>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'personal-mentor-app',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
	<div class="span7 right-border">
		<h3 class="centerTxt">You Pick</h3>
		<p class="centerTxt">Add students you wish to mentor to Your Picks using the + button.</p>
		<div class="row">
			<div class="span3">
			
				<?php $this->beginWidget('bootstrap.widgets.TbGridView', array(
					'id'=>'student-list',
					'summaryText'=>'',
					'type'=>'striped condensed hover',
					'dataProvider'=>$search->search(),
					'filter'=>$search,
					'columns'=>array(
							array(
								'name'  => 'pic_url',
								'type' => 'image',
								'header'=> '',
								'filter'=> '',
								'htmlOptions'=>array('width'=>'50px'),
						),
							array(
								'name'  => 'fullName',
								'value' => '($data->getFullName())',
								'header'=> 'Available Mentees',
								'filter'=> CHtml::activeTextField($search, 'fullName'),
						),
				))); ?>
				
				<?php $this->endWidget(); ?>
			</div>
			<div class="offset1 span3">
				<?php $this->beginWidget('bootstrap.widgets.TbGridView', array(
					'id'=>'my-picks',
					'summaryText'=>'',
					'type'=>'striped condensed hover',
					'dataProvider'=>$search->search(),
					'columns'=>array(
							array(
								'name'  => 'pic_url',
								'type' => 'image',
								'header'=> '',
								'htmlOptions'=>array('width'=>'50px'),
						),
							array(
								'name'  => 'fullName',
								'value' => '($data->getFullName())',
								'header'=> 'Your Picks',
								'filter'=> CHtml::activeTextField($search, 'fullName'),
						),
				))); ?>
				
				<?php $this->endWidget(); ?>
			</div>
		</div>
		
		
	</div>
	<div class="span5">
		<h3 class="centerTxt">System Pick Criteria</h3>
			    <p>How many students would you like to have assigned? If you would prefer to work with students from a specific university just add them to your preffered universities</p>
			    <br>
				<?php echo 'How many students'; ?>
		        <?php echo $form->textField($model,'system_pick_amount',array('size'=>2,'maxlength'=>2)); ?>
		        <?php echo $form->error($model,'system_pick_amount'); ?>
		    	<br>
		        <?php echo 'Preferred Universities'; ?>
		        <?php echo $form->textField($model,'max_amount',array('size'=>60,'maxlength'=>100)); ?>
		        <?php echo $form->error($model,'max_amount'); ?>
	</div>
</div>

<?php $this->endWidget();?>