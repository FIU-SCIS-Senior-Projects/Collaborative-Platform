<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Manage Projects'=>array('admin'),
	$model->title,
);


?>

<h2>Project <?php echo $model->title; ?></h2>

<div class="span6" style="width: 800px; margin-left: 0px;">
    <table cellpadding="0" cellspacing="0" border="0"
           class="table table-striped table-bordered table-fixed-header"
           id="#mytable" width="100%" style="table-layout:fixed">
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Project ID </h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->id; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Title</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->title; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Propose By</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $propose_by->fname.' '.$propose_by->lname; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Project Mentor</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php if($promentor != null)  echo $promentor->fname.' '.$promentor->lname; else echo  '---'; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Start Date</h5></td>
            <td style="background-color: #EEF1F3" width="85%"> <?php echo $model->start_date; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Due Date</h5></td>
            <td style="background-color: #EEF1F3" width="85%"> <?php echo $model->due_date; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Description</h5></td>
            <td style="background-color: #EEF1F3" width="85%"> <?php echo $model->description; ?> </td>
        </tr>
    </table>
</div>