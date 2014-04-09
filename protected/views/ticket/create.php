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

<div style = "color: #0044cc"><h1>New Ticket</h1></div>
<div id = "fullcontent" >
    <div
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>