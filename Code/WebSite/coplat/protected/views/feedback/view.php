
<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	$model->id,
);

if(User::getCurrentUserId() == $model->user_id)
{
	$this->menu=array(

        //array('label'=>'List Feedback', 'url'=>array('index')),
        //array('label'=>'Update Feedback', 'url'=>array('update', 'id'=>$model->id)),
        //array('label'=>'Delete this Feedback', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        //array('label'=>'Manage Feedback', 'url'=>array('admin')),
        array('label'=>'Update My Feedback','url'=>'#', 'linkOptions'=>array('submit'=>array('/feedback/update','id'=>$model->id))),
        array('label'=>'Add a Reply','url'=>'#', 'linkOptions'=>array('submit'=>array('/Feedback_Replies/create','id'=>$model->id))),);
}

else{
    if(User::isCurrentUserAnAdmin())
    {
        $this->menu=array(
            //array('label'=>'List Feedback', 'url'=>array('index')),
            //array('label'=>'Update Feedback', 'url'=>array('update', 'id'=>$model->id)),
            array('label'=>'Delete This Feedback', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
            array('label'=>'Reply to Feedback','url'=>'#', 'linkOptions'=>array('submit'=>array('/Feedback_Replies/create','id'=>$model->id))),);

    }
    else{

        $this->menu=array(
            //array('label'=>'List Feedback', 'url'=>array('index')),
           );

    }

}

?>


    <div style="color: #0044cc"><h3>Feedback</h3></div>
    <br>
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-fixed-header"
           id="example"
           width="80%">
        <thead class="header">
        <tr style="background-color: #EEE">
            <th width="20%">User</th>
            <th width="30%">Subject</th>
            <th width="65%">Description</th>

        </tr>
        </thead>


            <tbody>
            <tr>
                <td><?php echo User::getUser($model->user_id);?></td>
                <td><?php echo $model->subject; ?></td>
                <td><?php echo $model->description;?></td>

            </tr>
            </tbody>
            <?php

        ?>
    </table>


<br>


    <div style="color: #0044cc"><h3>Replies</h3></div>
    <br>
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-fixed-header"
           id="example"
           width="100%">
        <thead class="header">
        <tr style="background-color: #EEE">
            <th width="10%"> User</th>
            <th width="65%">Description</th>

        </tr>
        </thead>
        <?php $data1 = $model->gitReplies();
        foreach ($data1 as $comment) {
            ?>
            <tbody>
            <tr>
                <td><?php echo User::model()->getUser($comment->user_id); ?></td>
                <td><?php echo $comment->reply ?></td>


            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>



