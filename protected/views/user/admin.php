<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Manage Users',
);

/*$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.asearch-button').click(function(){
	$('.asearch-form').toggle();+
	$('.bsearch-form').toggle();
	return false;
});

$('.bsearch-button').click(function(){
	$('.bsearch-form').toggle();
	$('.asearch-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h2>Manage Users</h2>


<?php echo CHtml::link('Basic Search','#',array('class'=>'bsearch-button')); ?>
<br/>


<div class="bsearch-form" style="display:">


    <?php $this->renderPartial('search',array(
        'model'=>$model,
    )); ?>
</div>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'asearch-button')); ?>

<!-- search-form -->
<div class="asearch-form" style="display:none">



</div>


<?php //$linkfind ='href="/coplat/index.php/user/findMentors"'; ?>
<!--
<div style="float: left">
    <a <?php //echo $linkfind; ?>><img style="display: block;" border="0" src="/coplat/images/find.png" id="find" width="50" height="50">
        <p stlye="width: 200px; position: relative; top: -200px;">Find Domain Mentors</p>
    </a>
</div>
//-->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed hover',
    'id'=>'user-grid',
    'selectableRows'=>1,
    'selectionChanged'=>
        'function(id){ location.href = $.fn.yiiGridView.getSelection(id);}',
    //'selectionChanged'=>
    //   'function(data) { $("#viewModal .modal-body p").html(data); $("#viewModal").modal(); }',

    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'username',
        'email',
        'fname',
        //'mname',
        'lname',
        /**
        array(
            'name'=>'activated',
            'header'=>'Activated',
            'type'=>'raw',
            'htmlOptions'=>array('width'=>'10'),
        ),
        array(
            'name'=>'disable',
            'header'=>'Disable',
            'type'=>'raw',
            'htmlOptions'=>array('width'=>'10'),

             ),

        array(
            'name'=>'isProMentor',
            'header'=>'Project M.',
            'type'=>'raw',
        ),
        array(
            'name'=>'isDomMentor',
            'header'=>'Domain M.',
            'type'=>'raw',
        ),
        array(
            'name'=>'isPerMentor',
            'header'=>'Personal M.',
            'type'=>'raw',
        ),

        array(
            'class'=>'CButtonColumn',

        ),
         **/
    ))); ?>



<!-- View Popup  -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'viewModal')); ?>
<!-- Popup Header -->

<div class="modal-header">
    <h4>View Employee Details</h4>
</div>

<!-- Popup Content -->
<div class="modal-body">
    <p>Employee Details</p>

</div>
<!-- Popup Footer -->
<div class="modal-footer">

    <!-- close button -->
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <!-- close button ends-->
</div>
<?php $this->endWidget(); ?>
<!-- View Popup ends -->