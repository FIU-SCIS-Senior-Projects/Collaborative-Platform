<?php
/* @var $this UserController */
/* @var $model Ticket */

Yii::app()->clientScript->registerScript('modal', "
$('.details-button').click(function(){
	$('.details-form').toggle();
	return false;
});

$('.comments-button').click(function(){
	$('.comments-form').toggle();
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
					'label'=>'Creator',
					'type'=>'raw',
					'value'=>CHtml::encode($model->creatorUser->fname) .' '. CHtml::encode($model->creatorUser->lname),
			),
			array(
						'label'=>'Domain',
						'type'=>'raw',
						'value'=>CHtml::encode($model->domain->name),
				),
			array(
						'label'=>'Sub-Domain',
						'type'=>'raw',
						'value'=> CHtml::encode($model->getSubDomainID()),
				),
				array(
						'label'=>'Status',
						'type'=>'raw',
						'value'=> CHtml::encode($model->status),
				),
				array(
						'label'=>'Date Created',
						'type'=>'raw',
						'value'=> CHtml::encode(date("M d, Y g:i a", strtotime($model->created_date))),
				),
				array(
						'label'=>'Description',
						'type'=>'raw',
						'value'=> CHtml::encode($model->description),
				),
				array(
						'label'=>'Assigned To',
						'type'=>'raw',
						'value'=> CHtml::encode($model->getCompiledAssignedID()),
				),
				array(
						'label'=>'Priority',
						'type'=>'raw',
						'value'=> CHtml::encode($model->priority->description),
				),
				array(
						'label'=>'Attachment',
						'type'=>'raw',
						'value'=> CHtml::encode($model->file),
				),
		),
)); 
?>
</div>

<h3><?php echo CHtml::link('Comments','#',array('class'=>'comments-button')); ?></h3>
<hr>
<div class='well comments-form' style="display:">
<?php 				
                                        
                    $this->widget('bootstrap.widgets.TbGridView', array(
                    		'type'=>'striped condensed hover',
                    		'id'=>'id',
							'dataProvider'=>  new CArrayDataProvider($model->comments, array('keyField'=>'id')),
                    		'summaryText'=>'',
                    		//'filter'=>$model,
                    		'columns'=>array(
                    				'added_date',
                    				'description',
                    				'user_added',
                    		),
                    ));
?>
</div>