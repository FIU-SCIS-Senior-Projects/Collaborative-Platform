<?php
/* @var $this UserController */
/* @var $model User */
/* @var $infoModel UserInfo */

/*$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register New User',
);
*/
?>

<h2>Collaborative Platform Registration</h2>
<?php
	    echo $this->renderPartial('register', array('model'=>$model, 'infoModel'=>$infoModel, 'error'=>$error));
?>
<?php //print_r($_POST); ?>







