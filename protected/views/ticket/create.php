<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Create',
);

?>

<h1>Create Ticket</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>