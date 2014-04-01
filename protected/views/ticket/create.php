<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ticket', 'url'=>array('index')),
	array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>

<h1>Create Ticket</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>