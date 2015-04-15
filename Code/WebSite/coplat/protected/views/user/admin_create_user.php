<?php
/* @var $this UserController */
/* @var $model User */
$this->breadcrumbs=array(
 'Users'=>array('admin'),
		'Register New User',
);

?>

<h2>Collaborative Platform Registration</h2>
<?php
if($model->username == null || $error!=null)
{
     $this->renderPartial('add', array('model'=>$model, 'error'=>$error));
}else
{
     $this->renderPartial('roles', array('model'=>$model));
}
    
?>
<?php // print_r($_POST); ?>