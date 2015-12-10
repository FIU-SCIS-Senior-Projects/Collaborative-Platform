<?php
/* @var $this FeedbackController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Feedback */

$this->breadcrumbs=array(
	'Feedbacks',
);

/* Feel free to uncomment this code if you want to add menu items to admin and user views for index
if(User::isCurrentUserAnAdmin())
{
	$this->menu=array(
	);
}
else {

	$this->menu = array(

		//array('label'=>'Manage Feedback', 'url'=>array('admin')),
	);
}
*/
$this->menu=array();

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#feedback-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1>Feedbacks</h1>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array('model'=>$model,'data1'=>$data1,)); ?>
</div>
<?php

if(User::isCurrentUserAnAdmin())
{
	$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'domain-grid',
		'dataProvider'=> $model->search(),
		'filter'=>$model,
		//'filter'=>$model,
		'columns'=>array(
			//'id',
			array(
				'name'  => 'creatorName',
				'value' => '($data->getCompiledCreatorID())',
				'header'=> 'Name',
				'filter'=> CHtml::activeTextField($model, 'creatorName'))
			,
			array(
				'name'=>'subject',
				'value'=>'$data->subject'
			),
			array(
				'name'=>'description',
				'value'=>'$data->description'
			),
			array(
				'header'=>'Options',
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=> '{view} {delete}',
				'buttons'=>array(
					'view'=>
						array(
							'url'=>'Yii::app()->createUrl("feedback/view", array("id"=>$data->id))',

						),
				),
			)
		,)
	));
}

else
{
	$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'domain-grid',
		'dataProvider'=> $model->search(),
		'filter'=>$model,
		//'filter'=>$model,
		'columns'=>array(
			//'id',
			array(
				'name'  => 'creatorName',
				'value' => '($data->getCompiledCreatorID())',
				'header'=> 'Name',
				'filter'=> CHtml::activeTextField($model, 'creatorName'))
		,
			array(
				'name'=>'subject',
				'value'=>'$data->subject'
			),
			array(
				'name'=>'description',
				'value'=>'$data->description'
			),
			array(
				'header'=>'Options',
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=> '{view}',
				'buttons'=>array(
					'view'=>
						array(
							'url'=>'Yii::app()->createUrl("feedback/view", array("id"=>$data->id))',

						),
				),
			)
		,)
	));
}
?>
