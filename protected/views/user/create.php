<?php
/* @var $this UserController */
/* @var $model User */

/*$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register New User',
);
*/
?>

<h2>Collaborative Platform Registration</h2>
<?php

if($model->username == null || $error!=null){
    echo $this->renderPartial('register', array('model'=>$model, 'error'=>$error));
	echo("<script>console.log('New User Taco');</script>");
} else if ($model->activated != 0){
	$this->redirect("/coplat/index.php/home/userHome");
	echo("<script>console.log('New User Pizza');</script>");
}

?>
<?php //print_r($_POST); ?>







