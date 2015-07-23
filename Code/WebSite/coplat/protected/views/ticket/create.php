<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'New Ticket',
);

?>

<h1>New Question</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>