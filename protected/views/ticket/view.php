<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Ticket', 'url'=>array('index')),
	//array('label'=>'Create Ticket', 'url'=>array('create')),
	//array('label'=>'Update Ticket', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Ticket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>
<div id = "container">
	<span><strong>Ticket #<?php echo $model->id; ?> Details</strong></span>
	<div style="max-height: 300px; height: 300px; width: 1050px; border: 1px solid #C9E0ED; overflow-y: scroll; border-radius: 5px;">
	

	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
		'id',
		'creator_user_id',
		'topic_id',
		'status',
		'created_date',
		'last_updated',
		'subject',
		'description',
		'answer',
		'assign_user_id',
			),
	)); ?>

	</div>
</div> <!-- End Container -->

<div style = "margin-top: 15px">
	<div>
	<?php
	/*$this->menu=array( array('label'=>'List Ticket', 'url'=>array('index')),
	array('label'=>'Create Ticket', 'url'=>array('create')),
	array('label'=>'Update Ticket', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ticket', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ticket', 'url'=>array('admin')), );
*/
	$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'link', 'id'=>'new-box', 'url'=>'/coplat/index.php/ticket/create', 
				'type'=>'primary', 'label'=>'Create', ));
	?>
	
	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'link', 'id'=>'new-box', 'url'=> '/coplat/index.php/ticket/index',
		'type'=>'primary', 'label'=>'Cancel'));
	?>

    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
    		'buttonType'=>'link', 'id'=>'new-box', 'url'=>array('update', 'id'=>$model->id), 
			'type'=>'primary', 'label'=>'Update'));
	 ?>
	<?php 
    /*$this->widget('bootstrap.widgets.TbButton', array(
    		'buttonType'=>'link', 'id'=>'new-box', 'url'=>'#', 'linkOptions'=>array(
			'submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?'),
			'type'=>'primary', 'label'=>'Update')); */
	 ?>
	 
	</div>
</div>




