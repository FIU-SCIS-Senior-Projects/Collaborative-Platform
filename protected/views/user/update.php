<?php
/* @var $this UserController */
/* @var $model User */
if(User::isCurrentUserAdmin())
    {
        $this->breadcrumbs=array(
            'Manage Users'=>array('admin'),
            $model->fname,
        );
    }
?>

<?php echo $this->render('change', array('model'=>$model)); ?>