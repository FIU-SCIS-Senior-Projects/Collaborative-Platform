<?php
/* @var $this TicketController */
/* @var $dataProvider CActiveDataProvider */
/* @var $data Ticket */

$this->breadcrumbs=array(
	'Tickets',
);

$this->menu=array(
		//array('button'=>'New Ticket', 'url'=>array('create')),
		//array('label'=>'Manage Ticket', 'url'=>array('admin')),
		//array('label'=>'Create Ticket', 'url'=>array('create')),
		//array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>
<!-- 
<div class = "container" id = "page">  -->
<div id = "wrapper">
	<head><strong>My Tickets</strong></head>
	<!--  <div style="max-height: 150px; height: 150px; width: 1050px; border: 1px solid #C9E0ED; overflow-y: scroll; border-radius: 5px;">
	-->
	<div
		<?php /*$this->widget('zii.widgets.CListView', array('dataProvider'=>$dataProvider, 'itemView'=>'_view', 'summaryText' => '',
		'htmlOptions'=>array(
		'style'=>'overflow-y:scroll; height:150px; width: 1050px; border: 1px solid #C9E0ED'),)); */?>
		
		<?php $this->widget('zii.widgets.grid.CGridView', array('id'=> 'ticket_id',
    'dataProvider'=>$dataProvider, 'summaryText' => '',
    'columns'=>array( 
        'id',          // display the 'title' attribute
        //'creator_user_id',  // display the 'name' attribute of the 'category' relation
		'topic_id', 'status', 'created_date','last_updated',
		'subject', /*'description', 'answer', 'assign_user_id',*/),
      /*  'subject:html',   // display the 'content' attribute as purified HTML
        array(            // display 'create_time' using an expression
            'name'=>'create_date',
            'value'=>'date("M j, Y", $data->create_date)',
        ),*/
        /*array(            // display 'author.username' using an expression
            'name'=>'authorName',
            'value'=>'$data->author->username',
        ), */
    	/*array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        ),*/
				'htmlOptions'=>array(
						'style'=>'overflow-y:scroll; height:300px; width: 1050px; border: 1px solid #C9E0ED'),
   'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('ticket/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

)); ?>
	</div>
	<!-- Ticket options -->
	<div id="options">			
		<div style="margin-top:10px; margin-left: 15px">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
            	 'buttonType'=>'link', 'id'=>'new-box', 'url'=>'/coplat/index.php/ticket/create', 'type'=>'primary',
            	 'label'=>'New',)); ?>	
            <?php $this->widget('bootstrap.widgets.TbButton', array(
           		 'buttonType'=>'link', 'id'=>'new-box', 'url'=>'/coplat/index.php', 'type'=>'primary',
            	 'label'=>'Cancel', )); ?>	
		</div>
    
 	</div>
</div> <!-- End Wrapper -->
