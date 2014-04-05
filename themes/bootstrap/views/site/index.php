<?php 
	$this->redirect("/coplat/index.php/site/login");
	
	
	//$this->pageTitle=Yii::app()->name;
	$this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name 
    	),));
	 
?>


<?php $this->endWidget(); ?>