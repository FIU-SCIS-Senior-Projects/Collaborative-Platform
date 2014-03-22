<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Ticket', 'url'=>array('index')),
	//array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>

<div id = "wrapper" >
	<span><strong>New Ticket</strong></span>
		<div id = "new_ticket"; style = "width: 800px; border: 1px solid #C9E0ED">

			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div> 
</div>