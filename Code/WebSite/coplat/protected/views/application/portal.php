<?php
/* @var $this ApplicationController */

$buttons = addslashes(json_encode($buttons));

Yii::app()->clientScript->registerScript('register', "
	
		window.buttons = JSON.parse('" . $buttons . "');
				
		function disable(id){
			$(id).on('click', function (e) {
		        	e.preventDefault();
		    });
			$(id).parent().removeClass('grow');
			$(id).children('.btn').addClass('disabled');
			$(id).children('.btn').text('Pending...');
		}
		
		function setButtons(){
			if(window.buttons[0] == 0) disable('.personal-apply');
			if(window.buttons[1] == 0) disable('.project-apply');
			if(window.buttons[2] == 0) disable('.domain-apply');
		}
				
		setButtons();
");
?>

<h1 class="centerTxt">Apply for Mentorship</h1>

<div class="row">
	<div style="margin-left:5px;" class="span4">
		<div class="grow" style="padding:20px; height:175px;"><a class="personal-apply" href="/coplat/index.php/application/personal"><img border="0" src="/coplat/images/roles/personal.png" id="pjm" width="150" class="centerImg"></a></div>
		<h3 class="centerTxt">Personal Mentor</h3>
		</br>
			<p class="centerTxt">A personal mentor is someone who wishes to help specific mentee's,
            or students.  On your personal mentor application you will select one or more
            current mentee that you will help guide.  You will be able to see, and are
            encouraged to participate in, the questions the mentee asks as well as schedule
            meetings with the mentee.  Please make sure you will be available to work with
            this mentee for at least a semesters time.</p>
		</br>
		<div class="centerTxt">
			<a class="personal-apply" style="text-decoration:none" href="/coplat/index.php/application/personal">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'primary',
					'size'=>'large',
	                'label'=>'Apply',
	            )); ?>
            </a>
		</div>
	</div>
	<div class="span4">
		<div class="grow" style="padding:20px; height:175px;"><a class="project-apply" href="/coplat/index.php/application/project"><img border="0" src="/coplat/images/roles/project.png" id="dmm" width="150" class="centerImg"></a></div>
		<h3 class="centerTxt">Project Mentor</h3>	
		</br>
			<p class="centerTxt">A project mentor is tasked with overseeing one or more senior
            projects.  They will be able to see, and are encouraged to participate on, questions
            asked by the student members of the project.  The project mentor is advised to also
            schedule regular meetings with the members of the project.  Please ensure that
            you will be available for the semesters in which the project will be completed</p>
		</br>
		<div class="centerTxt">
			<a class="project-apply" style="text-decoration:none" href="/coplat/index.php/application/project">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'primary',
					'size'=>'large',
	                'label'=>'Apply',
	            )); ?>
            </a>
            </br>
            </br>
            </br>
            <a style="text-decoration:none" href="/coplat/index.php/">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'primary',
					'block'=>'true',
					'size'=>'large',
	                'label'=>'Done',
	            )); ?>
			</a>
			<a href=../application/viewhistory>
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'button',
					'type'=>'primary',
					'block'=>'true',
					'size'=>'large',
	                'label'=>'View Closed Applications',
					));?>
</a>
		</div>
	</div>
	<div class="span4">
		<div class="grow" style="padding:20px; height:175px;"><a class="domain-apply" href="/coplat/index.php/application/domain"><img border="0" src="/coplat/images/roles/domain.png" id="pm" width="150" class="centerImg"></a></div>
		<h3 class="centerTxt">Subject Expert</h3>
		</br>
			<p class="centerTxt">A subject expert is someone who is able to answer questions
            related to their expertise in a subject.  In the application to become a subject
            expert, there is a selection of subject matters and their related secondary
            subject matters.  By selecting any of these, and being accepted, questions
            posted to the system will be assigned to you.  Please make sure that you are
            available for the number of tickets you sign up for.</p>
		</br>
		<div class="centerTxt">
			<a class="domain-apply" style="text-decoration:none" href="/coplat/index.php/application/domain">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
	                'buttonType'=>'button',
	                'type'=>'primary',
					'size'=>'large',
	                'label'=>'Apply',
	            )); ?>
            </a>
		</div>
	</div>
</div>
