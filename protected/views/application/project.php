<?php
/*
* @var $this ApplicationController
* @var $applciation ApplicationPersonalMentor
* @var $data Project[]
* */

$projects = addslashes(json_encode($data));

Yii::app()->clientScript->registerScript('register', "

	window.projects = JSON.parse('" . $projects . "');
	window.selectedProjects = [];
	window.projectsGridLastSort = 'title';
	window.selectedGridLastSort = 'title';
			
	var template = $('#rowtemplate').clone();
	
	function generateProjectsGrid(sortByField) {
		var grid = $('#mygrid');
		
		// get the last sort method
		if (!sortByField) {
			sortByField = window.projectsGridLastSort;
		}
		
		// save the current sort method
		window.projectsGridLastSort = sortByField;
			
		// clear the table
		grid.find('.items-body').children().remove();
			
		var projectsCopy = jQuery.extend(true, [], projects);
		var sortedProjects = projectsCopy.sort(function(a, b) {
			return a[sortByField].localeCompare(b[sortByField]);
		});
		
		for (var i = 0; i < sortedProjects.length; i++) {
			var project = sortedProjects[i];	
			var row = template.clone();
			
			// fill in all the data here
			row.children('.project-id').text(project.id);
			row.children('.project-title').text(project.title);
			
			row.click(function(){
				moveToSelectedGrid($(this));
			});
			
			row.popover({
				html: true,
				content: '<div class=\"row-fluid\" style=\"width: 500px\"> \
							<div class=\"span12\"> \
								<strong style=\"font-size: 1.5em\">' + project.title + '</strong> \
								<br /><br />  Proposed By: ' + project.customer + ' \
							</div> \
						  </div> \
						<div class=\"row-fluid\" style=\"width: 500px\"> \
							<div class=\"span11\"> \
								<br /><strong style=\"font-size: 1.25em\"> Description: </strong> \
								<br /> ' + project.description + ' \
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
			
		var projectsCopy = jQuery.extend(true, [], selectedProjects);
		var sortedProjects = projectsCopy.sort(function(a, b) {
			return a[sortByField].localeCompare(b[sortByField]);
		});
		
		for (var i = 0; i < sortedProjects.length; i++) {
			var project = sortedProjects[i];	
			var row = template.clone();
			
			// fill in all the data here
			row.children('.project-id').text(project.id);
			row.children('.project-title').text(project.title);
			
			row.click(function(){
				moveToProjectsGrid($(this));
			});
			
			row.popover({
				html: true,
				content: '<div class=\"row-fluid\" style=\"width: 500px\"> \
							<div class=\"span12\"> \
								<strong style=\"font-size: 1.5em\">' + project.title + '</strong> \
								<br /><br />  Proposed By: ' + project.customer + ' \
							</div> \
						  </div> \
						<div class=\"row-fluid\" style=\"width: 500px\"> \
							<div class=\"span11\"> \
								<br /><strong style=\"font-size: 1.25em\"> Description: </strong> \
								<br /> ' + project.description + ' \
							</div> \
						</div>'
			});
			
			grid.find('.items-body').append(row);
		}
	}
			
	generateProjectsGrid();
	generateSelectedGrid();
	
	$('#mygrid').find('.items-header .project-title').click(function() {
		generateProjectsGrid('title');
	});

	$('#selectedgrid').find('.items-header .project-title').click(function() {
		generateSelectedGrid('title');
	});
			
	function moveToProjectsGrid(obj) {
		// clear the current click handler
		obj.off('click');
		
		// move the DOM object over to the other table
		var selector = $('#mygrid .items-body');
		if (selector.children('.item').length === 0) {
			selector.html(obj);	
		} else {
			selector.find('.item:last').after(obj);
		}
		
		// reassign the proper click handler
		obj.click(function(){
			moveToSelectedGrid(obj);
		});
		
		var idToRemove = obj.find('.project-id').text();
			
		for (var i = 0; i < window.selectedProjects.length; i++) {
			if (window.selectedProjects[i].id == idToRemove) {
				var projectObj = window.selectedProjects.splice(i, 1);
				window.projects.push(projectObj[0]);
			}
		}
			
		generateProjectsGrid();
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
		if (selector.children('.item').length === 0) {
			selector.html(obj);	
		} else {
			selector.find('.item:last').after(obj);
		}
		
		// reassign the proper click handler
		obj.click(function(){
			moveToProjectsGrid(obj);
		});
		
		var newId = obj.find('.project-id').text();
		
		for (var i = 0; i < window.projects.length; i++) {
			if (window.projects[i].id == newId) {
				var projectObj = window.projects.splice(i, 1);
				window.selectedProjects.push(projectObj[0]);
			}
		}
			
		generateProjectsGrid();
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
			
		if(window.selectedProjects.length === 0 && $('#sys').val() == 0){
			$('#main-error').removeClass('hidden');
			return false;
		} else $('#main-error').addClass('hidden');
				
		return valid;	
	}
			
	$('.next').click(function(){
		if(validateApp()){
			var grid = $('#verifygrid');

			// clear the table
			grid.find('.items-verify').children().remove();
			
			// get a list of current selections
			var currentIds = $('#hiddeninput').val().split(',');
			
			if(currentIds.length === 0){
				$('#your_picks_message').text('You have selected NO projects.');
			} else {
				$('#your_picks_message').text('You have selected these projects.');
				for(var i = 0; i < currentIds.length; i++){
					for(var j = 0; j < window.selectedProjects.length; j++){
						var project = window.selectedProjects[j];
						if(project.id === currentIds[i]){
							// make a row and add it to the verify grid
							var row = template.clone();
							row.children('.project-id').text(project.id);
							row.children('.project-title').text(project.title);
							if(i === 0) grid.find('.items-verify').html(row);
							else grid.find('.items-verify .item:last').after(row);
							break;
						}
					}
				}
			}
			
			if($('#sys').val() == 0) $('#system_picks_message').text('The system will pick NO projects for you.');
			else {
				$('#system_picks_message').text('The system will pick ' + $('#sys').val() +' projects for you.');			
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
			
");
?>

<h1 class="centerTxt">Project Mentor</h1>
<br>
<p class="centerTxt">From here you may select projects to mentor. You can hand pick projects from the list in the You Pick column. You can also provide criteria for automatic project selection.</p>
<br>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'project-mentor-app',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
	<div class="lightMarginL span8 right-border">
		<h3 class="centerTxt">You Pick</h3>
		<p class="centerTxt">Add projects you wish to mentor to Your Picks by clicking on them.</p>
		<div class="row">
			<div class="span4 lightMarginL">
				<style>
				html {overflow-y: scroll;}
				.item div {display: inline-block; float: left; padding: 0.3em; font-size: 0.9em; line-height: 1em; cursor: pointer}
				.items-header {background: url("/coplat/assets/f769f9db/gridview/bg.gif") repeat-x scroll left top white; color: white; padding-top: 5px}
				.items-body {height: 400px; overflow-y: scroll; background: #F8F8F8;}
				.header-pad {padding-left: 5px}			
				.project-id {display: none !important;}
				.project-title {width: 100%; border-left: 1px solid white; }
				</style>
				<div id="mygrid" class="grid-view">
					<div class="items">
						<div class="items-header row-fluid">
							<div class="project-title span4 header-pad">Project</div>
						</div>
						<div class="items-body row-fluid">
							<div class="item row-fluid" id="rowtemplate" data-trigger="hover" data-delay="500">
								<div class="project-id"></div>
								<div class="project-title span4" style="width: 95%; padding-top: 10px">Test</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="span4 lightMarginL">
			
				<div id="selectedgrid" class="grid-view">
					<div class="items">
						<div class="items-header row-fluid">
							<div class="project-title span4 header-pad">Project</div>
						</div>
						<div class="items-body row-fluid">
							<div class="item row-fluid" id="rowtemplate" data-trigger="hover" data-delay="500">
								<div class="project-id"></div>
								<div class="project-title span4">Test</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</div>
	</div>
	<div class="span4">
		<h3 class="centerTxt">System Pick Criteria</h3>
			    <p>How many projects would you like to have assigned?</p>
			    <br>
		        <?php echo $form->textField($application,'system_pick_amount',array('size'=>2,'maxlength'=>2, 'id'=>'sys')); ?>
				<p id='sys-error' class="note errMsg hidden">The amount entered is invalid.</p>
		    	<br>
		        <?php echo CHtml::hiddenField('picks', '', array('id'=>'hiddeninput'));?>	
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
		<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Close</button>
		<?php echo CHtml::submitButton('Submit', array("class"=>"btn btn-large btn-primary")); ?>
	</div>
</div>
<?php $this->endWidget();?>