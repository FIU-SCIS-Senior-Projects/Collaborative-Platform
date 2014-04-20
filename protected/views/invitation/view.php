<?php
/* @var $this InvitationController */
/* @var $model Invitation */

$this->breadcrumbs=array(
	'Manage Invitations'=>array('admin'),
    $model->name,
);
?>

<h2><?php echo $model->name; ?>'s Invitation </h2>
<div class="span6" style="width: 800px; margin-left: 0px;">
    <table cellpadding="0" cellspacing="0" border="0"
           class="table table-striped table-bordered table-fixed-header"
           id="#mytable" width="100%" style="table-layout:fixed">
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Invitation ID </h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->id; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Receiver</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->name; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>e-mail</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->email; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Sender</h5></td>
            <td style="background-color: #EEF1F3" width="85%"> <?php echo $model->administrator_user_id; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>System Administrator</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->administrator; ?></td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Mentor</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->mentor; ?></td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Mentee</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->mentee; ?></td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Employer</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->employer; ?></td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Judge</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->judge; ?></td>
        </tr>
    </table>
</div>