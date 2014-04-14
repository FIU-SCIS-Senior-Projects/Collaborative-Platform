<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'New Administrator',
);

/*$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);*/
?>

<h2 style="margin-left:300px">New Administrator</h2>
<?php echo $this->renderPartial('formAddAdmin', array('model'=>$model)); ?>