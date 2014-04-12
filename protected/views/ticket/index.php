<?php
/* @var $this TicketController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tickets',
);

$this->menu=array(
	array('label'=>'Create Ticket', 'url'=>array('create')),
	array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>

<h1>Tickets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
