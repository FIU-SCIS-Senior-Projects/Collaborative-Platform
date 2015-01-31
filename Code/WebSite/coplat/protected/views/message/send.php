<?php 

   $js = Yii::app()->clientScript;  
   $js->registerCoreScript('jquery.ui');
   $js->registerScriptFile(Yii::app()->theme->baseUrl .'/js/jquery.slimscroll.js');
   $js->registerScriptFile(Yii::app()->theme->baseUrl .'/jquery.slimscroll.min.js');
   $js->registerScriptFile(Yii::app()->theme->baseUrl .'/js/autocomplete/autocomplete.html.js');
     
?>

<?php
$this->breadcrumbs=array(
	'Message'=>array('/message'),
	'Send',
);
?>

<script>

function validateForm()
{
  var user =  $("#receiver").val();

  if (!user || /^\s*$/.test(user)) {
	  alert("'To' field is in the wrong format");
	  return false;
  }

  var specialChar1 = 0;
  var specialChar2 = 0;
  var specialChar3 = 0
  for (var i = 0; i < user.length; i++)
  {
	 var aChar = user.charAt(i)
	 if (aChar == '<')
		 specialChar1++;

	 if (aChar == '>')
		 specialChar2++;	 

	 if (aChar == '"')
		 specialChar3++;
  }

  //if (specialChar1 != specialChar2 || (specialChar2 != 0 && user.charAt(user.length - 2) != '>')) {
	// alert("'To' field is in the wrong format");
	// return false; 
 // }

  if ((specialChar3 % 2 != 0) || (specialChar3 >= 2 && specialChar1 == 0) || (specialChar3 >= 2 && user.charAt(0) != '"')) {
	  alert("'To' field is in the wrong format");
      return false; 
  }

  if (specialChar1 > specialChar3) {
	  alert("'To' field is in the wrong format");
      return false; 
  }	  
		  
  return true;  
}


	

</script>
<?php if ($username != null) {?>
  
   <?php if ($model->message == null) {?>
     <script>
     $(function(){
	     $("#theSubject").focus();	
     });
     </script>
   <?php } else { ?>
   
   <script>
   $(function(){
	  
	  $("#theMessage").focus();
	   
   });
   </script>
   
   
   <?php }?>
   
   
<?php } else {?>

<script>
$(function(){
	$("#receiver").focus();	
});
</script>
<?php }?>

<div id="top-nav">
	<span id="messages">Messages</span>				
</div>

<div id="wrapper">	
    <div id="options">			
        <div style="margin-top:5px">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'link',
                'id'=>'compose-box',
				'url'=>'/coplat/index.php/message/send',
				'type'=>'primary',
                'label'=>'Compose',
            )); ?>	
        </div>
        <!--<a id="compose-box" class="option-selection" href="/coplat/index.php/message/send" style="text-decoration:none">Compose</a>	-->
      
        <a id="inbox-option" class="option-selection" href="/coplat/index.php/message"
            style="text-decoration:none">Inbox</a>	   

        <a id ="sent-option" class="option-selection" href="/coplat/index.php/message?target=sent" 
            style="text-decoration:none">Sent</a>


        <a class="option-selection" href="/coplat/index.php/message?target=trash" 
            style="text-decoration:none">Trash</a>			   
    </div>
    <div id="message-content">		
        <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id'=>'Message', 'action'=> '/coplat/index.php/message/send',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('enctype' => 'multipart/form-data', 'name'=>'send_form',
                'onsubmit'=>'return validateForm()'),
            )); 
        ?>

        <div style="margin-top:5px">
            <span style="margin-left:30px">To:</span>
            <?php 
				/*if ($username != null)
                    echo $form->textField($model,'receiver', array('value'=>$username)); 
                else
                    echo $form->textField($model,'receiver', array('id'=>'receiver'));*/ 
    
                if ($username != null)
                   $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                      'name'=>'receiver',
                      'source'=>$users,
                      'value'=>$username,				 
                      'options'=>array('html'=>true),
                      'htmlOptions'=>array('size'=>100),				 
                     //'select'=>'js: function(event,ui){$("#data").val(ui.item.name);return false;}',
                     
                  ));
               else 
                $this->widget('MultiComplete', array(
                    'name'=>'receiver',
                    'source'=>$users,	
                    'splitter'=>',',		  		
                    'options'=>array('html'=>true),
                    'htmlOptions'=>array('size'=>100),			  		 
                )); 
            ?>
         
            <?php echo $form->error($model,'receiver'); ?>
        </div>

        <div>
            <span>Subject:</span>
            <?php 
                if($model->message != null)		
                    echo $form->textField($model,'subject', array('id'=>'theSubject', 
                            'value'=>"Re: " . $model->subject, 'style'=>'width:631px'));
                else	
                    echo $form->textField($model,'subject', array('id'=>'theSubject','style'=>'width:631px')); 
                  
                echo $form->error($model,'subject'); 
            ?>
        </div>
    
        <div>
            <?php 
                echo $form->textArea($model,'message', array('id'=>'theMessage', 'style'=>'width:631px', 'cols'=>110, 'rows'=>15,
                    'width'=>'691px')); 
            ?>
        </div>

        <div style="margin-left:20px">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'id'=>'send_button',
				'type'=>'primary',
                'label'=>'Send',
            )); ?>	
        </div>
        <!--
        <div>
            
            <input id="send_button" type="submit" name="yt0" value="Send" />
            <?php 
                echo CHtml::submitButton('Send', array('id'=>'send_button',"class"=>"btn btn-primary")); ?>
        </div>
        -->
			


        <?php $this->endWidget();?>

    </div>
</div>