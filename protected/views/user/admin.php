<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
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


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="margin-left:300px;display:none">
<?php $this->renderPartial('search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget(/*'zii.widgets.grid.CGridView'*/'bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		//'password',
		'email',
		'fname',
		//'mname',
		//'lname',
		//'pic_url',
		'activated',
		//'activation_chain',
		'disable',
		//'biography',
		//'linkedin_id',
		//'fiucs_id',
		//'google_id',
		//'isAdmin',
		//'isProMentor',
		//'isPerMentor',
		//'isDomMentor',
		//'isStudent',
		//'isMentee',
		//'isJudge',
		//'isEmployer',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
