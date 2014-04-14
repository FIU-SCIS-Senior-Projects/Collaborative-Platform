<?php
/* @var $this UserController */
/* @var $model User */

/*$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register New User',
);

$this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	//array('label'=>'Manage User', 'url'=>array('admin')),
);*/
?>

<h2>Collaborative Platform Registration</h2>
<?php echo $this->renderPartial('add', array('model'=>$model)); ?>