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
	

	<?php
	
	 	
	 	$this->widget('zii.widgets.CDetailView', array(
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
	<!-- New Button 
	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'link', 'id'=>'new-box', 'url'=>'/coplat/index.php/ticket/create', 
				'type'=>'primary', 'label'=>'New', ));
	?>-->
	<!-- Cancel Button and render to index -->
	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'link', 'id'=>'new-box', 'url'=> '/coplat/index.php/ticket/index',
		'type'=>'primary', 'label'=>'Cancel'));
	?>
	<!-- Update Button  -->
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
    		'buttonType'=>'link', 'id'=>'new-box', 'url'=>array('update', 'id'=>$model->id), 
			/*'confirm' => 'Do you want to proceed and make change on this ticket?',*/
			'type'=>'primary', 'label'=>'Edit'));
	 ?>
 
	 <!-- Comment Button -->
	 <?php	echo CHtml::button('Comment', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),
	 		)); 
	 ?>
	 
	 <!-- Re-Route Button -->
	 <?php	echo CHtml::button('Re-Route', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),
	 		)); 
	 ?>
	 <!-- Answer Button -->
	 <?php	echo CHtml::button('Answer', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),
	 		)); 
	 ?>
	 <!-- Delete Button -->
	<?php echo CHtml::button('Delete', array("class"=>"btn btn-primary", 'submit' => array('Delete', 'id'=>$model->id),
			'confirm' => 'Do you want to Drop this ticket from the Mentoring Module?')); ?>
	 
	</div>
</div>




