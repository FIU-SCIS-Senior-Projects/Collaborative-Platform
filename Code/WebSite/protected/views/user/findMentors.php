<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 7/15/14
 * Time: 9:28 PM
 */
$this->breadcrumbs=array(
    'Manage Users'=>array('admin'),
    'Find Domain Mentors',

);
?>

<h2>Find Domain Mentors</h2>

<?php




$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user-grid',
    'dataProvider' => $dataProviderCompined,
    'filter'=>$filtersForm,
    'columns' => array(
        array(
            'name'=>'sname',
            'header'=>'Sub-domain',
            'type'=>'raw',
        ),
        array(
            'name'=>'dname',
            'header'=>'Domain',
            'type'=>'raw',
        ),
        array(
            'name'=>'username',
            'header'=>'Username',
            'type'=>'raw',
        ),        array(
            'name'=>'fname',
            'header'=>'First Name',
            'type'=>'raw',
        ),
        array(
            'name'=>'lname',
            'header'=>'Last Name',
            'type'=>'raw',
        ),
        array(
            'name'=>'email',
            'header'=>'Email',
            'type'=>'raw',
        ),
        array(
            'name'=>'activated',
            'header'=>'Activated',
            'type'=>'raw',
        ),
        array(
            'name'=>'disable',
            'header'=>'Disable',
            'type'=>'raw',
        ),
        array(
            'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->controller->createUrl("user/{$data["id"]}")',
            'updateButtonUrl'=>'Yii::app()->controller->createUrl("user/update/{$data["id"]}")',
            'deleteButtonUrl'=>'Yii::app()->controller->createUrl("user/delete/{$data["id"]}")',
        ),



    ),
));

?>

