<?php 
	if(Yii::app()->user->isGuest)
	    $this->redirect("/coplat/index.php/site/login");
    elseif(User::isCurrentUserAdmin())
        $this->redirect("/coplat/index.php/home/adminHome");
    else
        $this->redirect("/coplat/index.php/home/userHome");
	
	
	//$this->pageTitle=Yii::app()->name;
	$this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name 
    	),));
	 
?>


<?php $this->endWidget(); ?>