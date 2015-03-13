<?php
/* @var $this VideoConferenceController */
/* @var $meetingsId array */



///* @var $dataProvider CActiveDataProvider */



$this->breadcrumbs=array(
	'Video Conferences',
);

$this->menu=array(
	array('label'=>'Create VideoConference', 'url'=>array('create')),
	array('label'=>'Manage VideoConference', 'url'=>array('admin')),
);

?>


<style>

    div.mbox{
        width: 500px;
        padding: 15px;
        background-color: #d9edf7;
        margin-bottom: 15px;
        border-radius: 4px;
    }
    p.mbox{
        margin: 0px;
    }
    a.mbox{
        color: #31708f;
    }


</style>




<h1>Video Conferences</h1>







<?php



    $vcs = VideoConference::model()->findAllByPk($meetingsId);





    foreach($vcs as $vc){
        $html = "
        <div class='mbox info'>
            <a href='../videoConference/%ID%'>%SUBJECT%</a>
            <p>%DATE%</p>
            <p>%NOTE%</p>
            <p>%PARTICIPANTS%</p>
        </div>";

        $html = str_replace("%ID%", $vc->id, $html);
        $html = str_replace("%SUBJECT%", $vc->subject, $html);
        $html = str_replace("%DATE%", $vc->scheduled_for, $html);
        $html = str_replace("%NOTE%", $vc->notes, $html);
        $html = str_replace("%PARTICIPANTS%", $vc->findParticipantsAsString(), $html);
        echo $html;
    }
?>








<?php
/*
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
*/
?>
