<?php
/* @var $this UserDomainController */
/* @var $model UserDomain */

$this->breadcrumbs=array(
	'User Domains'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List UserDomain', 'url'=>array('index')),
	//array('label'=>'Manage UserDomain', 'url'=>array('admin')),
);
?>


<div style = "color: #0044cc"><h1>Create Domain Mentor</h1></div>
<div id = "wrapper" >
    <div
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>