<?php
/* @var $this UserController */
/* @var $model User */
$this->breadcrumbs=array(
 'Users'=>array('admin'),
		'Register New Mentor',
);

?>

<h2>Collaborative Platform Registration</h2>
<?php
if($model->username == null || $error!=null)
    echo $this->renderPartial('add', array('model'=>$model, 'error'=>$error));
else
    echo $this->renderPartial('roles', array('model'=>$model));
?>
<?php // print_r($_POST); ?>