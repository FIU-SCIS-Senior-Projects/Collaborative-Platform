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

<div id = "fullcontent">

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
	 <?php	/*echo CHtml::button('Comment', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),
	 		)); */
	 ?>
	 <?php $this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>'Comment',
		    'type'=>'primary',
		    'htmlOptions'=>array(
		        'data-toggle'=>'modal',
		        'data-target'=>'#myModalComment',
				'style'=>'width: 100px', 
		    	),
			)); ?>

	 
	 <!-- Re-Route Button -->
	 <?php	/*echo CHtml::button('Re-Route', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),
	 		));*/ 
	 ?>
	 	 <!-- Button trigger modal -->
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalReAssign">
  		Re-Assign
		</button>
	 <!-- Answer Button -->
	 <?php	/*echo CHtml::button('Answer', array("class"=> "btn btn-primary", 'submit' => array('comment/create', 'id' =>$model->id),
	 		));*/ 
	 ?>
	 
	 	 <!-- Button trigger modal -->
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalAnswer">
  		Answer
		</button>
	 <!-- Delete Button -->
	<?php echo CHtml::button('Delete', array("class"=>"btn btn-primary", 'submit' => array('Delete', 'id'=>$model->id),
			'confirm' => 'Do you want to Drop this ticket from the Mentoring Module?')); ?>
	</div>
	</div>

	<br>
	<div id = "container">
	
	<span><strong>Comments</strong></span>

  	<div style="margin-top = 15px; max-height: 100px; height: 300px; width: 1050px; border: 1px solid #C9E0ED; overflow-y: scroll; border-radius: 5px;">
	<?php 

		/*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$comment,
	'attributes'=>array(
		'id',
		'comment',
		'added_date',
		'ticket_id',
	),
)); */?>
	
	<?php if($comment === NULL)
			{
				echo "No comments added yet";	
			}
			else
			{ 
				$this->widget('zii.widgets.CDetailView', array(
				'data'=>$comment[0],
				'attributes'=>array(
				'id',
				'description',
				'added_date',
				'ticket_id',
				),
			));
			} 
 	?>

	<?php  /*$this->widget('zii.widgets.grid.CGridView', array('id'=> 'comment_id',
    'dataProvider'=>$comment, 'summaryText' => '',
    'columns'=>array( 
        'id',
		'comment',
		'added_date', 'ticket_id'),
)); */?>
	
	</div>
</div> <!-- End Container -->
	

<?php /*$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); */?>
<!-- Modal FOR COMMENT-->

<div class="modal fade" id="myModalComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Append Comment to a Ticket #<?php echo $model->id?></h4>
      </div>
      	<div class="modal-body">
				<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'comment-form',
				//'enableAjaxValidation'=>false,
				)); ?>
      			<div style="margin-left:20px">
      				<?php $comment = new Comment();?>
 					<!--  	<input style ="display:none" type = "text" id = "ticket_id" value=<?php /*echo $model->id;*/?>></input>-->
					<?php echo $form->textArea($comment,'description',array(
							'id'=>'description', 'style'=>'width:480px', 'cols'=>20, 'rows'=>5,
              				'width'=>'400px')); ?>
              	</div>
			
     </div>
      <div class="modal-footer">
   		 <?php $this->widget('bootstrap.widgets.TbButton', array(
    	'buttonType'=>'Submit',
        'type'=>'primary',
        'label'=>'Append',
        'url'=>'#',
        'htmlOptions'=>array('id'=>'append'),	
    )); ?>
   
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>

<?php $this->endWidget()?>   
  </div>
</div>
<script>
$('a#append').on('click', function () {
	$.post('/coplat/index.php/comment/create/<?php echo $model->id?>',$('#comment-form').serialize(),function(message){
		window.location = location;	});
	return false;
})
</script>



<!-- Modal RE-ASSIGN-->
<div class="modal fade" id="myModalReAssign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Re-Assign Ticket</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Re-Assign</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal ANSWER TICKET-->
<div class="modal fade" id="myModalAnswer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Answer</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>

</div> <!-- END FULL CONTENT -->