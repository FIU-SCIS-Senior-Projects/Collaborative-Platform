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
			<p class="centerTxt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
			Aenean id nulla sollicitudin massa pretium porta vitae nec nisl. 
			Duis condimentum eleifend rhoncus. Nam molestie metus et diam 
			fringilla suscipit. Sed cursus ornare leo, sit amet ultrices erat 
			finibus non. Proin magna ante, finibus sed eros ut, mattis fringilla 
			sapien. Aenean sit amet suscipit lorem, nec vestibulum dui. 
			Vestibulum in orci justo. Integer quis purus vel mi sodales 
			pellentesque. </p>
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
			<p class="centerTxt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
			Aenean id nulla sollicitudin massa pretium porta vitae nec nisl. 
			Duis condimentum eleifend rhoncus. Nam molestie metus et diam 
			fringilla suscipit. Sed cursus ornare leo, sit amet ultrices erat 
			finibus non. Proin magna ante, finibus sed eros ut, mattis fringilla 
			sapien. Aenean sit amet suscipit lorem, nec vestibulum dui. 
			Vestibulum in orci justo. Integer quis purus vel mi sodales 
			pellentesque. </p>
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
		<h3 class="centerTxt">Domain Mentor</h3>
		</br>
			<p class="centerTxt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
			Aenean id nulla sollicitudin massa pretium porta vitae nec nisl. 
			Duis condimentum eleifend rhoncus. Nam molestie metus et diam 
			fringilla suscipit. Sed cursus ornare leo, sit amet ultrices erat 
			finibus non. Proin magna ante, finibus sed eros ut, mattis fringilla 
			sapien. Aenean sit amet suscipit lorem, nec vestibulum dui. 
			Vestibulum in orci justo. Integer quis purus vel mi sodales 
			pellentesque. </p>
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
