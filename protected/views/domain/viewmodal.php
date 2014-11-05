<?php
/* @var $this UserController */
/* @var $model Domains */

Yii::app()->clientScript->registerScript('modal', "
$('.details-button').click(function(){
	$('.details-form').toggle();
	return false;
});
");
?>

<h3><?php echo CHtml::link('#' . $model->id,'#',array('class'=>'details-button')); ?></h3>
<hr>
<div class='well details-form' style="display:">
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
					//'label'=>'Domain',
					//'type'=>'raw',
					//'value'=>CHtml::encode($model->name),
			),
			array(
						//'label'=>'SubDomain',
						//'type'=>'raw',
						//'value'=>CHtml::encode($model->getSubDomain()),
				),
				array(
						'label'=>'Description',
						'type'=>'raw',
						'value'=> CHtml::encode($model->description),
				),
				array(
						'label'=>'Validator',
						'type'=>'raw',
						'value'=> CHtml::encode($model->validator),
				),
				array(
						'label'=>'Need',
						'type'=>'raw',
						'value'=> CHtml::encode($model->need),
				),
				array(
						'label'=>'Need Amount',
						'type'=>'raw',
						'value'=> CHtml::encode($model->need_amount),
				),
		),
)); 
?>
</div>