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

<h2>Update User Profile</h2>
<?php echo $this->renderPartial('change', array('model'=>$model)); ?>