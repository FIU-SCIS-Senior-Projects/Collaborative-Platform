<?php
/* 
 * @var $this ApplicationController 
 * @var $model ApplicationPersonalMentor
 * @var $user User
 * @var $universities University[]
 * */
Yii::app()->clientScript->registerScript('register', "
	$('#selectedgrid tr:last').html('');
		
	$('#mygrid tr').click(function(){
		moveToSelected($(this));
	});

	function moveToMyGrid(obj) {
		// clear the current click handler
		obj.off('click');
		
		// move the DOM object over to the other table
		$('#mygrid > .items tr:last').after(obj);
		
		// reassign the proper click handler
		obj.click(function(){
			moveToSelected(obj);
		});
		
		var idToRemove = obj.children('td').children('input').val();
		var currentIds = $('#hiddeninput').val().split(',');
		for(var i = 0; i < currentIds.length; i++){
		 	if(currentIds[i] === idToRemove){
				currentIds.splice(i, 1);
			}
		}
		var result = currentIds.join(',');
		$('#hiddeninput').val(result);
	};
		
	function moveToSelected(obj) {
		// clear the current click handler
		obj.off('click');
		
		// move the DOM object over to the other table
		$('#selectedgrid > .items tr:last').before(obj);
		
		// reassign the proper click handler
		obj.click(function(){
			moveToMyGrid(obj);
		});
		
		var newId = obj.children('td').children('input').val();
		var currentIds = $('#hiddeninput').val();
		var separator = (currentIds === '') ? '' : ',';
		$('#hiddeninput').val(currentIds + separator + newId);
	};

");
?>

<h1 class="centerTxt">Personal Mentor</h1>
<br>
<p class="centerTxt">From here you may select students to mentor. You can hand pick students from the list in the You Pick column. You can also provide criteria for automatic student selection.</p>
<br>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'personal-mentor-app',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
	<div class="lightMarginL span8 right-border">
		<h3 class="centerTxt">You Pick</h3>
		<p class="centerTxt">Add students you wish to mentor to Your Picks by clicking on them.</p>
		<div class="row">
			<div class="span4 lightMarginL">
				<style>
				html {overflow-y: scroll;}
				#mygrid .summary {display: none;}
				.grid-view table.items tr.odd {background: #F8F8F8;}
				#mygrid, #selectedgrid {height: 400px; overflow-y: scroll};
				</style>
				<?php $this->beginwidget('ext.selgridview.SelGridView', array(
					    'id' => 'mygrid',
					    'dataProvider' => $user->searchNoPagination(),
						'selectableRows' => 2,
						'columns'=>array(
								array(
										'name'  => 'pic_url',
										'type' => 'image',
										'header'=> '',
										'filter'=> '',
										'htmlOptions'=>array('width'=>'60px'),
								),
								array(
										'name'  => 'fullName',
										'value' => '($data->getFullName())',
										'header'=> 'Mentee',
										'filter'=> CHtml::activeTextField($user, 'fullName'),
								),
								array(
										'name'  => 'university',
										'value' => '($data->getUniversityName())',
										'filter'=> '',
								),
				)));?>
				<?php $this->endWidget(); ?>
			</div>
		<div class="span4 lightMarginL">
			<?php $this->beginwidget('ext.selgridview.SelGridView', array(
					    'id' => 'selectedgrid',
					    'dataProvider' => new CActiveDataProvider('User', array('criteria'=>array('condition'=>'2=3'))),
						'selectableRows' => 2,
						'columns'=>array(
								array(
										'name'  => 'pic_url',
										'type' => 'image',
										'header'=> '',
										'filter'=> '',
										'htmlOptions'=>array('width'=>'60px'),
								),
								array(
										'name'  => 'fullName',
										'value' => '($data->getFullName())',
										'header'=> 'Mentee',
										'filter'=> CHtml::activeTextField($user, 'fullName'),
								),
								array(
										'name'  => 'university',
										'value' => '($data->getUniversityName())',
										'filter'=> '',
								),
				)));?>
				<?php $this->endWidget(); ?>
		</div>
	</div>
		</div>
	<div class="span4">
		<h3 class="centerTxt">System Pick Criteria</h3>
			    <p>How many students would you like to have assigned? If you would prefer to work with students from a specific university just add them to your preffered universities</p>
			    <br>
		        <?php echo $form->textFieldGroup($model,'system_pick_amount',array('size'=>2,'maxlength'=>2)); ?>
		        <?php echo $form->error($model,'system_pick_amount'); ?>
		    	<br>
		    	<style>
				#ApplicationPersonalMentor_system_pick_amount {height: 34px;}
				</style>
		        <?php echo $form->dropDownListGroup($model, 'university_id', array('wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		         																'widgetOptions'=>array(
																		        	'data' => $universities,
																					'htmlOptions' => array(),
		        )));?>
		        <?php echo $form->error($model,'university_id'); ?>
		        
		        <?php echo CHtml::hiddenField('picks', '', array('id'=>'hiddeninput'));?>	
	</div>
</div>
<div class="text-center">
<?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-large btn-primary")/*$model->isNewRecord ? 'Create' : 'Save'*/); ?>
<a style="text-decoration:none" href="/coplat/index.php/application/portal">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'button',
                'type'=>'danger',
				'size'=>'large',
                'label'=>'Cancel',
            )); ?>
</a>
</div>
<?php $this->endWidget();?>