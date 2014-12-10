<?php
/* @var $this UserController */
/* @var $model User */
/* @var $infoModel UserInfo */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('register', "
		
	function setInvalid(id, errId){
		$(errId).removeClass('hidden');
		$(id).addClass('txt_error');
	}
		
	function setValid(id, errId){
		$(errId).addClass('hidden');
		$(id).removeClass('txt_error');
	}
		
	window.error = '" . $error . "';
			
	function takenCheck(){
		if(window.error === 'username or email taken'){
			setInvalid('#uname', '#taken-error');	
			$('#email').addClass('txt_error');
		}		
	}
	takenCheck();
	
	function validateAccountInfo(){
		var valid = true;
		var alphaNum = /^[a-z0-9]+$/i;
		var emailReg = /^[^@]{1,64}@[^@]{1,255}$/;
		var numReg = /^\d+$/;
		
		if($('#fname').val().length < 1){
			setInvalid($('#fname'), $('#fname-error'));
			valid = false;
		} else setValid($('#fname'), $('#fname-error'));
		
		if($('#lname').val().length < 1){
			setInvalid($('#lname'), $('#lname-error'));
			valid = false;
		} else setValid($('#lname'), $('#lname-error'));
		
		if($('#uname').val().length < 4 || !alphaNum.test($('#uname').val())){
			setInvalid($('#uname'), $('#uname-error'));
			valid = false;
		} else setValid($('#uname'), $('#uname-error'));

		if(!emailReg.test($('#email').val())){
			setInvalid($('#email'), $('#email-error'));
			valid = false;
		} else setValid($('#email'), $('#email-error'));

		if($('#pass1').val().length < 5) {
			setInvalid($('#pass1'), $('#pass1-error'));
			valid = false;
        } else 	setValid($('#pass1'), $('#pass1-error'));
		
		if($('#pass1').val() != $('#pass2').val()) {
			setInvalid($('#pass2'), $('#pass2-error'));
			valid = false;
        } else 	setValid($('#pass2'), $('#pass2-error'));
		
		if($('#emp').val().length < 1){
			setInvalid($('#emp'), $('#emp-error'));
			valid = false;
		} else setValid($('#emp'), $('#emp-error'));
		
		if($('#pos').val().length < 1){
			setInvalid($('#pos'), $('#pos-error'));
			valid = false;
		} else setValid($('#pos'), $('#pos-error'));
		
		if($('#grad').val().length != 4 || !numReg.test($('#grad').val())){
			setInvalid($('#grad'), $('#grad-error'));
			valid = false;
		} else setValid($('#grad'), $('#grad-error'));
		
		if($('#uni').val().length < 1){
			setInvalid($('#uni'), $('#uni-error'));
			valid = false;
		} else setValid($('#uni'), $('#uni-error'));
		
		if($('#fos').val().length < 1){
			setInvalid($('#fos'), $('#fos-error'));
			valid = false;
		} else setValid($('#fos'), $('#fos-error'));
		
		if($('#deg').val() == 'Select'){
			setInvalid($('#deg'), $('#deg-error'));
			valid = false;
		} else setValid($('#deg'), $('#deg-error'));

		return valid;
	}
		
	$('.next2').click(function(){
		if(validateAccountInfo()){
			$('#fname-verify').text('Name: ' + $('#fname').val() + ' ' + $('#mname').val() + ' ' + $('#lname').val());
			$('#uname-verify').text('Userame: ' + $('#uname').val());
			$('#email-verify').text('Email: ' + $('#email').val());
			$('#emp-verify').text('Employer: ' + $('#emp').val());
			$('#pos-verify').text('Position: ' + $('#pos').val());
			$('#deg-verify').text('Degree: ' + $('#deg').val());
			$('#uni-verify').text('University: ' + $('#uni').val());
			$('#fos-verify').text('Field of Study: ' + $('#fos').val());
			$('#grad-verify').text('Graduation Year: ' + $('#grad').val());
			$('#verify').modal('toggle');
		}

		return false;
	});

	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});

");
?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-Register-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
    <div class="rowfluid">
    	<div class="span12 lightMarginL">
	    	<div class="account-info">
				<div class="row-fluid">
					<h4>Account Info</h4>
					<div class="span3 lightMarginL">
						<?php echo $form->labelEx($model,'fname'); ?>
				        <?php echo $form->textField($model,'fname',array('size'=>45,'maxlength'=>45, 'width'=>'50px', 'id'=>'fname')); ?>
				        <p id='fname-error' class="note errMsg hidden">This field is required.</p>
				    </div>
					<div class="span3 lightMarginL">
						<?php echo $form->labelEx($model,'mname'); ?>
			        	<?php echo $form->textField($model,'mname',array('size'=>45,'maxlength'=>45, 'id'=>'mname')); ?>
			        	<?php echo $form->error($model,'mname'); ?>
				    </div>
				    <div class="span3 lightMarginL">
						<?php echo $form->labelEx($model,'lname'); ?>
				        <?php echo $form->textField($model,'lname',array('size'=>60,'maxlength'=>100, 'id'=>'lname')); ?>
				        <p id='lname-error' class="note errMsg hidden">This field is required.</p>
				    </div>
				</div>
				<div class="row-fluid">
					<div class="span3 lightMarginL">
						<?php echo $form->labelEx($model,'email'); ?>
				        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'id'=>'email')); ?>
				        <p id='email-error' class="note errMsg hidden">Email is not formatted correctly.</p>
					</div>
					<div class="span3 lightMarginL">
						<?php echo $form->labelEx($model,'username'); ?>
				        <?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45, 'id'=>'uname')); ?>
						<p id='uname-error' class="note errMsg hidden">Username must be alphanumeric and have at least 4 characters.</p>
				    </div>
				    <p id='taken-error' class="note errMsg hidden centerTxt">Username or email taken.</p>
				</div>
				<div class="row-fluid">
					<div class="span3 lightMarginL">
						<?php echo $form->labelEx($model,'password'); ?>
				        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255, 'id'=>'pass1')); ?>
						<p id='pass1-error' class="note errMsg hidden">Password must be more than 5 characters.</p>
				    </div>
					<div class="span3 lightMarginL">
						<?php echo $form->labelEx($model,'password2'); ?>
				        <?php echo $form->passwordField($model,'password2',array('size'=>60,'maxlength'=>255, 'id'=>'pass2')); ?>
						<p id='pass2-error' class="note errMsg hidden">Passwords do not match.</p>
					</div>
				</div>
			</div>
	    	<div class="personal-info">
	    		<div class="rowfluid">
	    			<div class="span3 lightMarginL">
	    				<h4>Work Experience</h4>
	    				<?php echo $form->labelEx($infoModel,'employer'); ?>
				        <?php echo $form->textField($infoModel,'employer',array('size'=>60,'maxlength'=>255, 'id'=>'emp')); ?>
						<p id='emp-error' class="note errMsg hidden">This field is required.</p>
				        				        
				        <?php echo $form->labelEx($infoModel,'position'); ?>
				        <?php echo $form->textField($infoModel,'position',array('size'=>60,'maxlength'=>255, 'id'=>'pos')); ?>
						<p id='pos-error' class="note errMsg hidden">This field is required.</p>
				    </div>
	    			<div class="span3 lightMarginL">
	    				<h4>Education</h4>
						<?php $data = array('Select', 'Currently Pursuing Degree', 'Bachelors', 'Masters', 'PhD')?>
				        <?php echo $form->dropDownListRow($infoModel,'degree',array_combine($data, $data), array('id'=>'deg')); ?>
						<p id='deg-error' class="note errMsg hidden">A degree must be selected.</p>
				        						
						<?php echo $form->labelEx($infoModel,'field_of_study'); ?>
				        <?php echo $form->textField($infoModel,'field_of_study',array('size'=>60,'maxlength'=>255, 'id'=>'fos')); ?>
						<p id='fos-error' class="note errMsg hidden">This field is required.</p>
				        
	    			</div>
	    			<div class="span3 lightMarginL">
	    			<br/><br/>
						<?php echo $form->labelEx($infoModel,'university'); ?>
				        <?php echo $form->textField($infoModel,'university',array('size'=>60,'maxlength'=>255, 'id'=>'uni')); ?>
						<p id='uni-error' class="note errMsg hidden">This field is required.</p>
				        						
						<?php echo $form->labelEx($infoModel,'grad_year'); ?>
				        <?php echo $form->textField($infoModel,'grad_year',array('size'=>60,'maxlength'=>255, 'id'=>'grad')); ?>
						<p id='grad-error' class="note errMsg hidden">Year entered is invalid.</p>
					</div>
	    		</div>
			</div>
			<div class="span9 centerTxt">
	            <a href="#verify" role="button" class="btn btn-large btn-primary next2" data-toggle="modal">Next</a>
	          	<a style="text-decoration:none" href="/coplat/index.php/site/login">
					<?php $this->widget('bootstrap.widgets.TbButton', array(
		                'buttonType'=>'button',
		                'type'=>'danger',
						'size'=>'large',
		                'label'=>'Cancel',
		            )); ?>
          		</a>
			</div>
		</div>
    </div>	
    <div id="verify" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<br/>
			<h3 id="myModalLabel">Summary</h3>
			<br/>
			<p>Please verify that the entered information is correct</p>
		</div>
		<div class="modal-body">
			<h4>Account Info</h4>
			<p id='fname-verify'></p>
			<p id='mname-verify'></p>
			<p id='lname-verify'></p>
			<p id='uname-verify'></p>
			<p id='email-verify'></p>
			<h4>Work Experience</h4>
			<p id='emp-verify'></p>
			<p id='pos-verify'></p>
			<h4>Education</h4>
			<p id='deg-verify'></p>
			<p id='uni-verify'></p>
			<p id='fos-verify'></p>
			<p id='grad-verify'></p>
		</div>
		<div class="modal-footer">
			<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Back</button>
			<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-large btn-primary', 'id'=>'regsubmit')); ?>
		</div>
	</div>
</div>  
<?php $this->endWidget(); ?>