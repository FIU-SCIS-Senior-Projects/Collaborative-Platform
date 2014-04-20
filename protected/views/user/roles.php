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
<?php echo $this->redirect('/coplat/index.php/user/setRoles/'.$model->id); ?>