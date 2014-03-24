<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	//$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Ticket', 'url'=>array('index')),
	//array('label'=>'Create Ticket', 'url'=>array('create')),
	//array('label'=>'View Ticket', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>


<div id = "wrapper" >
	<span><strong>Edit Ticket <?php echo $model->id; ?></strong> </span>
		<div 

			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div> 
</div>


