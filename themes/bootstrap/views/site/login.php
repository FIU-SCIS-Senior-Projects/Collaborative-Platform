<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/*
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);*/
?>
<br><br><br>

<div class="form"  style="width:800px; margin:0 auto;">

    <!--<img style="float:left; height:50px; margin-left:50px"src='/coplat/images/mentor.png'/>
    <h2 style="margin-bottom:40px;float:left;margin-left:10px">Collaborative Platform Login</h2>

    -->
    <div style="float:left; border:1px solid;width: auto" align="center">
        <?php $this->widget('bootstrap.widgets.TbCarousel', array(
            'items'=>array(
                array('image'=>'/coplat/images/carousel/img1.jpeg', 'label'=>'Collaborative Platform', 'caption'=>'Collaborative Platform is a space'),
                array('image'=>'/coplat/images/carousel/img2.jpg', 'label'=>'Collaborative Platform', 'caption'=>'Collaborative Platform is a space'),
                array('image'=>'/coplat/images/carousel/img3.jpg', 'label'=>'Collaborative Platform', 'caption'=>'Collaborative Platform is a space'),

            ),
            'htmlOptions' => array('style'=>'width:400px;'),
        )); ?>
    </div>




    <div id="login" style="height: 60px">

        <div id="googlelogin" style="height: 60px">
            <?php
            $image = CHtml::image(Yii::app()->baseUrl.'/images/login/fiu_cs_login.png');
            echo CHtml::link($image, '?r=Login/fiu_oauth2')."<br><br><br>";
            ?>
        </div>

        <?php
			$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            	'id'=>'login-form',
				'type'=>'horizontal',
            	'enableClientValidation'=>true,
            	'clientOptions'=>array(
                'validateOnSubmit'=>true,
            	),
        	)); 
		?>
    
		<?php echo $form->textField($model,'username',array('placeholder'=>'User Name')); ?>
        <?php echo $form->error($model,'username'); ?></br></br>
    
        <?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
        <?php echo $form->error($model,'password'); ?></br></br>
        
        <?php 
			echo $form->checkBox($model,'rememberMe',array('style'=>'float:left')); 
		?>
		<p style="float:left; margin-left:5px">Remember Me</p></br></br>
        
        <div style="float:left;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>'Login',
            )); ?>	
        </div>
        
		<div style="float:left; margin-left: 10px;margin-top: -5px;">
			<a style="float:left;" href= "/coplat/index.php/site/forgotPassword" >  Forgot Password? </a>	
			<div style="clear:both"></div>
			<a style="float:left;" href= "/coplat/index.php/user/create" > Register  </a>	
		</div>

        
   </div>


<?php $this->endWidget(); ?>
</div><!-- form -->
