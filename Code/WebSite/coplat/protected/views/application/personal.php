<?php
/* 
 * @var $this ApplicationController 
 * @var $model ApplicationPersonalMentor
 * @var $user User
 * @var $universities University[]
 * */

$students = addslashes(json_encode($students));

Yii::app()->clientScript->registerScript('register', "
		
	window.students = JSON.parse('" . $students . "');
	window.selectedStudents = [];
	window.studentsGridLastSort = 'name';
	window.selectedGridLastSort = 'name';
	
	var template = $('#rowtemplate').clone();
	
	function generateStudentsGrid(sortByField) {
		var grid = $('#mygrid');
		
		// get the last sort method
		if (!sortByField) {
			sortByField = window.studentsGridLastSort;
		}
		
		// save the current sort method
		window.studentsGridLastSort = sortByField;
			
		// clear the table
		grid.find('.items-body').children().remove();
			
		var studentsCopy = jQuery.extend(true, [], students);
		var sortedStudents = studentsCopy.sort(function(a, b) {
			return a[sortByField].localeCompare(b[sortByField]);
		});
		
		for (var i = 0; i < sortedStudents.length; i++) {
			var student = sortedStudents[i];	
			var row = template.clone();
			
			// fill in all the data here
			row.children('.student-id').text(student.id);
			row.children('.student-avatar').find('img').attr('src', student.avatar);
			row.children('.student-name').text(student.name);
			row.children('.student-university').text(student.university);
			
			row.click(function(){
				moveToSelectedGrid($(this));
			});
			
			row.popover({
				html: true,
				content: '<div class=\"row-fluid\" style=\"width: 500px\"> \
						<div class=\"span3\"><img src=\"' + student.avatar + '\"></div> \
						<div class=\"span8\"> \
							<strong style=\"font-size: 1.5em\">' + student.name + '</strong> \
							<br />' + student.university + '<br /><a href=\"mailto:' + student.email + '\">' + student.email + '</a> \
						</div> \
						</div> \
						<div class=\"row-fluid\" style=\"width: 500px\"> \
							<div class=\"span6\"> \
								<br /><strong style=\"font-size: 1.25em\">Project:</strong> \
								<br />' + student.project + ' \
							</div> \
							<div class=\"span6\"> \
								<br /><strong style=\"font-size: 1.25em\">Personal Mentor:</strong> \
								<br /><img src=\"' + student.mentor.avatar + '\" style=\"width:50px\">  ' + student.mentor.name + ' \
							</div> \
						</div>'
			});
			
			grid.find('.items-body').append(row);
		}
	}
			
	function generateSelectedGrid(sortByField) {
		var grid = $('#selectedgrid');
		
		// get the last sort method
		if (!sortByField) {
			sortByField = window.selectedGridLastSort;
		}
		
		// save the current sort method
		window.selectedGridLastSort = sortByField;
			
		// clear the table
		grid.find('.items-body').children().remove();
			
		var studentsCopy = jQuery.extend(true, [], selectedStudents);
		var sortedStudents = studentsCopy.sort(function(a, b) {
			return a[sortByField].localeCompare(b[sortByField]);
		});
		
		for (var i = 0; i < sortedStudents.length; i++) {
			var student = sortedStudents[i];	
			var row = template.clone();
			
			// fill in all the data here
			row.children('.student-id').text(student.id);
			row.children('.student-avatar').find('img').attr('src', student.avatar);
			row.children('.student-name').text(student.name);
			row.children('.student-university').text(student.university);
			
			row.click(function(){
				moveToStudentsGrid($(this));
			});
			
			row.popover({
				html: true,
				content: '<div class=\"row-fluid\" style=\"width: 500px\"> \
							<div class=\"span3\"><img src=\"' + student.avatar + '\"></div> \
							<div class=\"span8\"> \
								<strong style=\"font-size: 1.5em\">' + student.name + '</strong> \
								<br />' + student.university + '<br /><a href=\"mailto:' + student.email + '\">' + student.email + '</a><br />' + student.project + ' \
							</div> \
						</div> \
						<div class=\"row-fluid\" style=\"width: 500px\"> \
							<div class=\"span6\"> \
								<br /><strong style=\"font-size: 1.25em\">Project:</strong> \
								<br />' + student.project + ' \
								<br />' + student.description + ' \
							</div> \
							<div class=\"span6\"> \
								<br /><strong style=\"font-size: 1.25em\">Personal Mentor:</strong> \
								<br /><img src=\"' + student.mentor.avatar + '\" style=\"width:50px\">  ' + student.mentor.name + ' \
							</div> \
						</div>'
			});
			
			grid.find('.items-body').append(row);
		}
	}
			
	generateStudentsGrid();
	generateSelectedGrid();

	$('#mygrid').find('.items-header .student-name').click(function() {
		generateStudentsGrid('name');
	});

	$('#mygrid').find('.items-header .student-university').click(function() {
		generateStudentsGrid('university');
	});

	$('#selectedgrid').find('.items-header .student-name').click(function() {
		generateSelectedGrid('name');
	});
			
	$('#selectedgrid').find('.items-header .student-university').click(function() {
		generateSelectedGrid('university');
	});
			
	function moveToStudentsGrid(obj) {
		// clear the current click handler
		obj.off('click');
		
		// move the DOM object over to the other table
		var selector = $('#mygrid .items-body');
		var verifier = $('#verifygrid .items-verify');
			
		if (selector.children('.item').length === 0) {
			selector.html(obj);	
		} else {
			selector.find('.item:last').after(obj);
		}
		
		// reassign the proper click handler
		obj.click(function(){
			moveToSelectedGrid(obj);
		});
		
		var idToRemove = obj.find('.student-id').text();
			
		for (var i = 0; i < window.selectedStudents.length; i++) {
			if (window.selectedStudents[i].id == idToRemove) {
				var studentObj = window.selectedStudents.splice(i, 1);
				window.students.push(studentObj[0]);
			}
		}
			
		generateStudentsGrid();
		generateSelectedGrid();
		
		var currentIds = $('#hiddeninput').val().split(',');
		for(var i = 0; i < currentIds.length; i++){
		 	if(currentIds[i] === idToRemove){
				currentIds.splice(i, 1);
			}
		}
		var result = currentIds.join(',');
		$('#hiddeninput').val(result);
	};
		
	function moveToSelectedGrid(obj) {
		// clear the current click handler
		obj.off('click');
		
		// move the DOM object over to the other table
		var selector = $('#selectedgrid .items-body');
		var verifier = $('#verifygrid .items-verify');
		var copy = obj.clone();

		if (selector.children('.item').length === 0) {
			selector.html(obj);
			verifier.html(copy);	
		} else {
			selector.find('.item:last').after(obj);
			verifier.find('.item:last').after(copy);
		}
		
		// reassign the proper click handler
		obj.click(function(){
			moveToStudentsGrid(obj);
		});
		
		var newId = obj.find('.student-id').text();
		
		for (var i = 0; i < window.students.length; i++) {
			if (window.students[i].id == newId) {
				var studentObj = window.students.splice(i, 1);
				window.selectedStudents.push(studentObj[0]);
			}
		}
			
		generateStudentsGrid();
		generateSelectedGrid();
		
		var currentIds = $('#hiddeninput').val();
		var separator = (currentIds === '') ? '' : ',';
		$('#hiddeninput').val(currentIds + separator + newId);
	};
			
	function setInvalid(id, errId){
		$(errId).removeClass('hidden');
		$(id).addClass('txt_error');
	}
		
	function setValid(id, errId){
		$(errId).addClass('hidden');
		$(id).removeClass('txt_error');
	}
			
	function validateApp(){
		var valid = true;
		var numReg = /^\d+$/;

		if(!numReg.test($('#sys').val())){
			setInvalid($('#sys'), $('#sys-error'));
			return false;
		} else setValid($('#sys'), $('#sys-error'));
		
		if(window.selectedStudents.length === 0 && $('#sys').val() == 0){
			$('#main-error').removeClass('hidden');
			return false;
		} else $('#main-error').addClass('hidden');
				
		return valid;	
	}
			
	function generateSystemPicks(){
		var preferred = [];
		var notselected = [];
		var picked = $('#hiddeninput').val().split(',');
		var selected = false;
			
		for(var i = 0; i < window.students.length; i++){
			var student = window.students[i];
			
			// check if this student was selected
			for(var j = 0; j < picked.length; j++){
				if(student.id == picked[j]){
					// this student has been selected set flag
					selected = true;
					break;
				}
			}
			
			// check if student is from the preferred university
			if(!selected && student.university == $('#ApplicationPersonalMentor_university_id option:selected').text()){
				preferred.push(student);
				var sysPicks = $('#hiddensystem').val();
				var separator = (sysPicks === '') ? '' : ',';
				$('#hiddensystem').val(sysPicks + separator + student.id);
			} else if(!selected) notselected.push(student);
			
			
			// If there were sufficient students from the preferred school, stop
			if(preferred.length >= $('#sys').val()) return;
			
			// reset flag
			selected = false;
		}
		
		// if there were insufficient students from the preferred school, then fill with whats left
		for(var i = 0; i < notselected.length && $('#sys').val() > preferred.length + i; i++) {
			var sysPicks = $('#hiddensystem').val();
			var separator = (sysPicks === '') ? '' : ',';
			$('#hiddensystem').val(sysPicks + separator + notselected[i].id);
		}
	}
			
	$('.next').click(function(){
		if(validateApp()){
			// reset system picks
			$('#hiddensystem').val('');
			
			// generate system picks
			if($('#sys').val() > 0) generateSystemPicks();
			
			var grid = $('#verifygrid');

			// clear the table
			grid.find('.items-verify').children().remove();
			
			// get a list of current selections
			var currentIds = $('#hiddeninput').val().split(',');
			
			if(currentIds[0] === ''){
				$('#your_picks_message').text('You have selected NO mentees.');
			} else {
				$('#your_picks_message').text('You have selected these mentees.');
				for(var i = 0; i < currentIds.length; i++){
					for(var j = 0; j < window.selectedStudents.length; j++){
						var student = window.selectedStudents[j];
						if(student.id === currentIds[i]){
							// make a row and add it to the verify grid
							var row = template.clone();
							row.children('.student-id').text(student.id);
							row.children('.student-avatar').find('img').attr('src', student.avatar);
							row.children('.student-name').text(student.name);
							row.children('.student-university').text(student.university);
							if(i === 0) grid.find('.items-verify').html(row);
							else grid.find('.items-verify .item:last').after(row);
							break;
						}
					}
				}
			}
			
			if($('#sys').val() == 0) $('#system_picks_message').text('The system will pick NO mentees for you.');
			else {
				$('#system_picks_message').text('The system will pick ' + $('#sys').val() +' mentees for you from ' + $('#ApplicationPersonalMentor_university_id :selected').text() + '.');			
			}
			
			$('#verify').modal('toggle');
		}
		return false;
	});
	
	(function($) {
	
	    var oldHide = $.fn.popover.Constructor.prototype.hide;
	
	    $.fn.popover.Constructor.prototype.hide = function() {
	        if (this.options.trigger === \"hover\" && this.tip().is(\":hover\")) {
	            var that = this;
	            // try again after what would have been the delay
	            setTimeout(function() {
	                return that.hide.call(that, arguments);
	            }, that.options.delay.hide);
	            return;
	        }
	        oldHide.call(this, arguments);
	    };
	
	})(jQuery);
	
	$(function (){
         $('.infopop').popover();
      });
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
		<p class="centerTxt">Just click to add students to Your Picks.  <a class="btn btn-mini btn-info infopop" data-content="Hover over a student for more info. Click on column header to filter by Mentee or University." data-placement="right" data-toggle="popover" data-trigger="hover"><i class="icon-info-sign icon-white"></i></a></p>
		<div class="row">
			<div class="span4 lightMarginL">
				<style>
				html {overflow-y: scroll;}
				.item div {display: inline-block; float: left; padding: 0.3em; font-size: 0.9em; line-height: 1em; cursor: pointer}
				.items-header {background: url("/coplat/assets/f769f9db/gridview/bg.gif") repeat-x scroll left top white; color: white; padding-top: 5px}
				.items-body {height: 400px; overflow-y: scroll; background: #F8F8F8;}
				.header-pad {padding-left: 5px}
				.student-id {display: none !important;}
				.student-avatar {width: 20%; padding: 0}
				.student-name {width: 40%}
				.student-university {width: 40%}
				</style>
				<div id="mygrid" class="grid-view">
					<div class="items">
						<div class="items-header row-fluid">
							<div class="student-avatar span2"></div>
							<div class="student-name span4 header-pad">Mentee</div>
							<div class="student-university span5 header-pad">University</div>
						</div>
						<div class="items-body row-fluid">
							<div class="item row-fluid tbl-row" id="rowtemplate" data-trigger="hover" data-delay="500">
								<div class="student-id"></div>
								<div class="student-avatar span2"><img src="/coplat/images/profileimages/avatarsmall.gif" alt=""></div>
								<div class="student-name span4 selector-center">Ingrid Troche</div>
								<div class="student-university span5 selector-center">Florida International University</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="span4 lightMarginL">
			
				<div id="selectedgrid" class="grid-view">
					<div class="items">
						<div class="items-header row-fluid">
							<div class="student-avatar span2"></div>
							<div class="student-name span4 header-pad">Mentee</div>
							<div class="student-university span5 header-pad">University</div>
						</div>
						<div class="items-body row-fluid">
							<div class="item row-fluid tbl-row" id="rowtemplate" data-trigger="hover" data-delay="500">
								<div class="student-id"></div>
								<div class="student-avatar span2"><img src="/coplat/images/profileimages/avatarsmall.gif" alt=""></div>
								<div class="student-name span4 selector-center">Ingrid Troche</div>
								<div class="student-university span5 selector-center">Florida International University</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</div>
	</div>
	<div class="span4">
		<h3 class="centerTxt">System Pick Criteria</h3>
			    <p>How many students would you like to have assigned? If you would prefer to work with students from a specific university just add them to your preffered universities</p>
			    <br>
		        <?php echo $form->textField($model,'system_pick_amount',array('size'=>2,'maxlength'=>2, 'id'=>'sys')); ?>
				<p id='sys-error' class="note errMsg hidden">The amount entered is invalid.</p>
		    	<br>
		        <?php echo $form->dropDownListGroup($model, 'university_id', array('wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		         																'widgetOptions'=>array(
																		        	'data' => $universities,
																					'htmlOptions' => array(),
																				'id'=>'uni',
		        )));?>
		        <?php echo $form->error($model,'university_id'); ?>
		        
		        <?php echo CHtml::hiddenField('picks', '', array('id'=>'hiddeninput'));?>	
		        <?php echo CHtml::hiddenField('systempicks', '', array('id'=>'hiddensystem'));?>
	</div>
</div>
<div class="text-center">
	<a href="#verify" role="button" class="btn btn-large btn-primary next" data-toggle="modal">Next</a>
	<a style="text-decoration:none" href="/coplat/index.php/application/portal">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'danger',
					'size'=>'large',
	                'label'=>'Cancel',
	            )); ?>
	</a>
	<h4 id='main-error' class="note errMsg hidden">Must select a mentee for the list or have the system pick one for you.</h4>
	
</div>
<div id="verify" class="modal hide fade text-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<br/>
		<h3 id="myModalLabel">Summary</h3>
		<br/>
		<p>Please verify that the entered information is correct</p>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span7">
				<h4>Your Picks</h4>
				<p id="your_picks_message"></p>
				<div id="verifygrid" class="grid-view">
					<div class="items">
						<div class="items-verify row-fluid">
						</div>
					</div>
				</div>
			</div>
			<div class="span5 lightMarginL">
				<h4>System Picks</h4>
				<p id="system_picks_message"></p>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Back</button>
		<?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-large btn-primary")); ?>
	</div>
</div>
<?php $this->endWidget();?>