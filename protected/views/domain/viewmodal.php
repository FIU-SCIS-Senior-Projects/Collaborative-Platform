<?php
/* @var $this DomainController */
/* @var $model Domains */

Yii::app()->clientScript->registerScript('modal', "
$('.details-button').click(function(){
	$('.details-form').toggle();
	return false;
});
		
		$('.tickets-button').click(function(){
	$('.tickets-form').toggle();
	return false;
});
		
		$('.mentors-button').click(function(){
	$('.mentors-form').toggle();
	return false;
});
");
?>

<div class='well details-form' style="display:none">
<h3><?php echo CHtml::link('Domain - ' . $model->name,'#',array('class'=>'details-button')); ?></h3>
</div>

<div class='well details-form' style="display:">
<h3><?php echo CHtml::link('Domain - ' . $model->name,'#',array('class'=>'details-button')); ?></h3>
<hr>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
					'label'=>'Domain',
					'type'=>'raw',
					'value'=>CHtml::encode($model->name),
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

<!-- TICKETS START -->
<div class='well tickets-form' style="display:">
<h3><?php echo CHtml::link('Tickets','#',array('class'=>'tickets-button')); ?></h3>
</div>

<div class='well tickets-form' style="display:none">
<h3><?php echo CHtml::link('Tickets','#',array('class'=>'tickets-button')); ?></h3>
<hr>
<?php 	    
	    			$thisID = $model->id;
                    $rawData = new CSqlDataProvider('SELECT id, subject, assigned_date, t.status FROM ticket t WHERE t.subdomain_id IS NULL && t.domain_id = '.$thisID.'');
                   
                                        
                    $this->widget('bootstrap.widgets.TbGridView', array(
                    		'type'=>'striped condensed hover',
                    		'id'=>'tickets',
                    		'dataProvider'=>$rawData,
                    		'summaryText'=>'',
                    		//'filter'=>$model,
                    		'columns'=>array(
                    				array(
                    						'name'=>'',
											'value'=>'$data["id"]',  
                    						'header'=>'ID'                  						
                    					),
                    				array(
                    						'name'=>'',
                    						'value'=>'$data["subject"]',
                    						'header'=>'Subject'
                    				),
                    				array(
                    						'name'=>'',
                    						'value'=>'$data["assigned_date"]',
                    						'header'=>'Assigned Date'
                    				),
                    				array(
                    						'name'=>'',
                    						'value'=>'$data["status"]',
                    						'header'=>'Status'
                    				),
                    				array(
                    						'header'=>'Options',
                    						'class'=>'bootstrap.widgets.TbButtonColumn',
                    						'template'=> '{view}',
                    						'buttons'=>array(
                    								'view'=>
                    								array(
                    										'url'=>'Yii::app()->createUrl("ticket/view", array("id"=>$data["id"]))',
                    											
                    								),
                    						),
                    				),
                    		),
                    )); ?>
</div>
<!-- TICKETS END -->

<!-- MENTORS START -->
<div class='well mentors-form' style="display:">
<h3><?php echo CHtml::link('Mentors','#',array('class'=>'mentors-button')); ?></h3>
</div>

<div class='well mentors-form' style="display:none">
<h3><?php echo CHtml::link('Mentors','#',array('class'=>'mentors-button')); ?></h3>
<hr>
<?php
                    $this->widget('bootstrap.widgets.TbGridView', array(
                    		'type'=>'striped condensed hover',
                    		'id'=>'mentors',
                    		'dataProvider'=>new CArrayDataProvider($model->userDomains, array('keyField'=>'id')),
                    		'summaryText'=>'',
                    		//'filter'=>$model,
                    		'columns'=>array(
                    				'id',
                    				'user_id',
                    				'domain_id',
                    				'subdomain_id',
                    				'rate',
                    				'active',
                    				'tier_team',
                    				array(
                    						'header'=>'Options',
                    						'class'=>'bootstrap.widgets.TbButtonColumn',
                    						'template'=> '{view}',
                    						'buttons'=>array(
                    								'view'=>
                    								array(
                    										'url'=>'Yii::app()->createUrl("user/viewmodal", array("id"=>$data->user_id))',
                    											
                    								),
                    						),
                    				),
                    		),
                    )); ?>
</div>
<!-- MENTORS END -->