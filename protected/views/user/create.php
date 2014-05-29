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
    if($model->username == null)
        echo $this->renderPartial('add', array('model'=>$model));
    else
        echo $this->renderPartial('roles', array('model'=>$model));
?>