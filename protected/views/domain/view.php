<?php
/* @var $this DomainController */
/* @var $model Domain */

$this->breadcrumbs=array(
	'Manage Domains'=>array('admin'),
	$model->name,
);

?>

<h2><?php echo $model->name; ?> Domain</h2>
<div class="span6" style="width: 800px; margin-left: 0px;">
    <table cellpadding="0" cellspacing="0" border="0"
           class="table table-striped table-bordered table-fixed-header"
           id="#mytable" width="100%" style="table-layout:fixed">
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Domain ID </h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->id; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Name</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->name; ?> </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Description</h5></td>
            <td style="background-color: #EEF1F3" width="85%">
                <?php echo $model->description; ?>
            </td>
        </tr>
        <tr>
            <td style="background-color: #C9E0ED" width="15%"><h5>Proficiency Cutoff</h5></td>
            <td style="background-color: #EEF1F3" width="85%"><?php echo $model->validator; ?></td>
        </tr>
    </table>
</div>

