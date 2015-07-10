<?php
/* @var $this AwayMentorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Away Mentors',
);

$this->menu=array(
	array('label'=>'Create AwayMentor', 'url'=>array('create')),
	array('label'=>'Manage AwayMentor', 'url'=>array('admin')),
);
?>

<h1>Away Mentors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>


<style>
        .error-message {
            background-color: #f2dede;
            border-radius: 3px;
            padding: 10px;
        }
        div.mbox {
            width: 500px;
            padding: 15px;
            margin-bottom: 15px;
            margin-top:30px;
            border-radius: 4px;
        }
        .mbox p {
            margin: 0px 0px 0px;
        }
        a.mbox {
            color: #31708f;
        }
        .mbox span {
            font-weight: bold;
            margin-right: 6px;
        }
        .mbox ul {
            margin: 0;
        }
        .mbox hr {
            border-top: 1px solid #19536c;
            border-bottom: 0px;
            margin: 5px 0px;
        }
        .ui-tooltip {
            padding: 3px;
            font-size: smaller;
        }
        .mbox button, .mbox .btn{
            padding: 2px 4px;
            font-size: small;
            margin-right: 4px;
        }
        .cancelled{
            background-color: #f4ffbc;
        }
    </style>
