<?php
/* @var $this TicketController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	//'Tickets',
);


$this->menu=array(
	//array('label'=>'Create Ticket', 'url'=>array('create')),
	//array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>

<div style = "color: #0044cc"><h1>Ticket List</h1></div>

<div id="fullcontent">


    <!--  <div style="max-height: 150px; height: 150px; width: 1050px; border: 1px solid #C9E0ED; overflow-y: scroll; border-radius: 5px;">
    -->
    <div>
        <?php /*$this->widget('zii.widgets.CListView', array('dataProvider'=>$dataProvider, 'itemView'=>'_view', 'summaryText' => '',
		'htmlOptions'=>array(
		'style'=>'overflow-y:scroll; height:150px; width: 1050px; border: 1px solid #C9E0ED'),)); */?>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$dataProvider, //->setPagination(true),
            //'filter'=>$model,
            'summaryText' => '',
            //'pager'=> array( 'class'=> 'CLinkPager', 'pageSize' => 50,),
            'columns'=>array(
                'id',          // display the 'title' attribute
                //'creator_user_id',  // display the 'name' attribute of the 'category' relation
                //array('name'=>'domain_id', 'type'=>'raw',
                    /**Var Domain $data */
                    //'value'=> CHtml::encode($data->,  //CHtml::encode($data->domain->name)),
                    'domain_id', 'status', 'created_date',
                'subject', /*'description', 'answer', 'assign_user_id',*/),
            //'headerHtmlOptions'=>array('width'=>'80px'),
            //'style'=>'overflow-y:scroll; height:300px; width: 1050px; border: 1px solid #C9E0ED; border-radius: 5px'),
            'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('ticket/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

        )); ?>
        <!-- Cancel Button -->
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'link', 'id'=>'new-box', 'url'=>'/coplat/index.php', 'type'=>'primary',
            'label'=>'Home', )); ?>
        &nbsp;&nbsp;
        <!-- New Ticket Button -->
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'link', 'id'=>'new-box', 'url'=>'/coplat/index.php/ticket/create', 'type'=>'primary',
            'label'=>'  New Ticket ',)); ?>
    </div>

</div> <!-- End FullContent -->
