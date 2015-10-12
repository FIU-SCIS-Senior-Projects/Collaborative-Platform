<?php
/* @var $this FeedbackController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Feedback */

$this->breadcrumbs=array(
	'Feedbacks',
);

$this->menu=array(
	array('label'=>'Create Feedback', 'url'=>array('create')),
	array('label'=>'Manage Feedback', 'url'=>array('admin')),
);
?>

<h1>Feedbacks</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'domain-grid',
	'dataProvider'=>new CArrayDataProvider($data),
	//'filter'=>$model,
	'columns'=>array(
		//'id',

		'id',
		'user_id',
		'subject',
		'description',
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
)); ?>
