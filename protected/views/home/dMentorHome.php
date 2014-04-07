<?php
/**
 * Created by PhpStorm.
 * User: lorenzo_mac
 * Date: 4/4/14
 * Time: 11:02 PM
 */

?>

<div id="fullcontent">
    <div style="color: #0044cc"><h2>Domain Mentor Home</h2></div>
    <br>

    <div><h3><?php echo $user->fname; ?> <?php echo $user->lname; ?></h3></div>
    <br>
    <div><h4>My Tickets</h4></div>
    <div id="fullcontent">


        <!--  <div style="max-height: 150px; height: 150px; width: 1050px; border: 1px solid #C9E0ED; overflow-y: scroll; border-radius: 5px;">
        -->
        <div>
            <?php /*$this->widget('zii.widgets.CListView', array('dataProvider'=>$dataProvider, 'itemView'=>'_view', 'summaryText' => '',
		'htmlOptions'=>array(
		'style'=>'overflow-y:scroll; height:150px; width: 1050px; border: 1px solid #C9E0ED'),)); */?>
<!-- >

<div style="color: #0044cc"><h3>Comments</h3></div>
<div> <!-- List of Comments to a Ticket -->
            <div style="height: 300px; width: 1000px; overflow-y: scroll; border-radius: 5px;">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="#mytable" width="100%">

                <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Creator Name</th>
                            <th width="10%">Domain</th>
                            <th width="50%">Subject</th>
                            <th width="20%">Created Date</th>
                        </tr>
                        </thead>
                        <?php foreach($Tickets as $Ticket)
                        {
                            $domain = Domain::model()->findBySql("SELECT * FROM domain WHERE id=:id", array(":id"=>$Ticket->domain_id));
                            $creator = User::model()->find("id=:id", array(":id"=>$Ticket->creator_user_id)); ?>

                            <tbody>
                            <tr>
                                <td ><?php echo $Ticket->id; ?></td>
                                <td><?php echo $creator->fname.' '.$creator->lname; ?></td>
                                <td><?php echo $domain->name;?></td>
                                <td><?php echo $Ticket->subject; ?></td>
                                <td><?php echo date("M d, Y", strtotime($Ticket->created_date )); ?></td>
                            </tr>
                            </tbody>
                        <?php
                        }
                        ?>
                    </table>
                </div>

           <?php /* $this->widget('zii.widgets.grid.CGridView', array(

                'dataProvider'=>$Tickets, //->setPagination(true),
                //'filter'=>$model,
                'summaryText' => '',
                //'pager'=> array( 'class'=> 'CLinkPager', 'pageSize' => 50,),
                'columns'=>array(
                    'id',      // display the 'title' attribute
                    //'creator_user_id',  // display the 'name' attribute of the 'category' relation
                    //array('name'=>'domain_id', 'type'=>'raw',
                    /**Var Domain $data */
                    //'value'=> CHtml::encode($data->,  //CHtml::encode($data->domain->name)),
                    //'domain_id', 'status', 'created_date',
                    /*'subject', 'description', 'answer', 'assign_user_id',),*/
                //'headerHtmlOptions'=>array('width'=>'80px'),
                //'style'=>'overflow-y:scroll; height:300px; width: 1050px; border: 1px solid #C9E0ED; border-radius: 5px'),
               // 'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('ticket/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

            //)); ?>
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
</div>

