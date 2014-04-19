<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Manage Users'=>array('admin'),
	'New Administrator',
);

?>

<h2 style="margin-left:300px">New Administrator</h2>
<?php echo $this->renderPartial('formAddAdmin', array('model'=>$model)); ?>