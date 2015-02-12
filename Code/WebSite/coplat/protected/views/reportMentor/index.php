<?php
$this->breadcrumbs=array('Mentor Report');
?>
<h2>Mentor Report</h2>
<style type="text/css">

   table {
        table-layout: fixed;
        width:2000px;
    }
    .container  {
          display:table;   
    }

    .grid-view  {
         display:table;
         padding-top:0px;
      }

    .summary {
        text-align:left !important;
    }

    .uneditable-input {
      height:30px !important;
    }

    textarea,
input[type="text"],
input[type="password"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
.uneditable-input {
 height:30px !important;
}

</style>
<?php

function getMentorColumns($model)
{
          
    $columns = array();
          
    //ticket ID
    $columns[]  = array('name'  => 'userID',
                        'header'=> 'Mentor User ID',
                        'filter'=> CHtml::activeNumberField($model, 'userID'),
                        'headerHtmlOptions' => array('width'=>'75', ));
 
    //name
    $columns[] =  array('name'  => 'name',
                        'header'=> 'Mentor Name',
                        'filter'=> CHtml::activeTextField($model, 'name'),
                        'headerHtmlOptions' => array('width'=>'200', ));
   
    //email    
    $columns[] =  array('name'  => 'email',
                        'header'=> 'Mentor Email',
                        'filter'=> CHtml::activeEmailField ($model, 'email'),
                        'headerHtmlOptions' => array('width'=>'200', ));     
    
    
    //userName
    $columns[] =  array('name'  => 'userName',
                       'header'=> 'Mentor User Name',
                       'filter'=> CHtml::activeTextField ($model, 'userName'),
                       'headerHtmlOptions' => array('width'=>'120', ));     
    
    //disabled
    $columns[] =  array('name'  => 'disabled',
                       'header'=> 'Mentor Disabled',
                       'value' => 'ReportUtils::getZeroOneToYesNo($data->disabled)',
                       'filter'=> array('1'=>'Yes','0'=>'No'),
                       'headerHtmlOptions' => array('width'=>'80', )); 
    
    
    $columns[] =  array('name'  => 'isProjectMentor',
                       'header'=> 'Project Mentor',
                       'value' => 'ReportUtils::getZeroOneToYesNo($data->isProjectMentor)',
                       'filter'=> array('1'=>'Yes','0'=>'No'),
                       'headerHtmlOptions' => array('width'=>'80', ));   
    
    $columns[] =  array('name'  => 'isPersonalMentor',
                      'header'=> 'Personal Mentor',
                      'value' => 'ReportUtils::getZeroOneToYesNo($data->isPersonalMentor)',
                      'filter'=> array('1'=>'Yes','0'=>'No'),
                      'headerHtmlOptions' => array('width'=>'80', ));     
   
    $columns[] =  array('name'  => 'isDomainMentor',
                     'header'=> 'Domain Mentor',
                     'value' => 'ReportUtils::getZeroOneToYesNo($data->isDomainMentor)',
                     'filter'=> array('1'=>'Yes','0'=>'No'),
                     'headerHtmlOptions' => array('width'=>'80', ));    
    
    $columns[] =  array('name'  => 'isJudge',
                    'header'=> 'Judge',
                    'value' => 'ReportUtils::getZeroOneToYesNo($data->isJudge)',
                    'filter'=> array('1'=>'Yes','0'=>'No'),
                    'headerHtmlOptions' => array('width'=>'80', ));  
    
    
    $columns[] =  array('name'  => 'isNew',
                    'header'=> 'Is New',
                    'value' => 'ReportUtils::getZeroOneToYesNo($data->isNew)',
                    'filter'=> array('1'=>'Yes','0'=>'No'),
                    'headerHtmlOptions' => array('width'=>'80', )); 
    
    $columns[] =  array('name'  => 'isEmployer',
                   'header'=> 'Is Employer',
                   'value' => 'ReportUtils::getZeroOneToYesNo($data->isEmployer)',
                   'filter'=> array('1'=>'Yes','0'=>'No'),
                   'headerHtmlOptions' => array('width'=>'80', ));
    
    $columns[] =  array('name'  => 'employer',
                   'header'=> 'Mentor Employer',
                   'filter'=> CHtml::activeTextField ($model, 'employer'),
                   'headerHtmlOptions' => array('width'=>'200', ));
    
    $columns[] =  array('name'  => 'position',
                   'header'=> 'Mentor Position',
                   'filter'=> CHtml::activeTextField ($model, 'position'),
                   'headerHtmlOptions' => array('width'=>'200', ));
    
    $columns[] =  array('name'  => 'fieldOfStudy',
                   'header'=> 'Mentor Field Of Study',
                   'filter'=> CHtml::activeTextField ($model, 'fieldOfStudy'),
                   'headerHtmlOptions' => array('width'=>'200', ));
   
    $columns[] =  array('name'  => 'degree',
                  'header'=> 'Mentor Degree',
                   'filter'=> CHtml::activeTextField ($model, 'degree'),
                  'headerHtmlOptions' => array('width'=>'200', ));
   
    $columns[] =  array('name'  => 'gradYear',
                 'header'=> 'Mentor Graduation Year',
                  'filter'=> CHtml::activeNumberField ($model, 'gradYear'),
                 'headerHtmlOptions' => array('width'=>'200', ));
     
    
   return $columns;
}

    $this->widget('bootstrap.widgets.TbGridView', 
                    array('id'=>'mentor-grid',                          
                        'type'=>'striped condensed',
                        'dataProvider'=> $model->search(),
                        'filter'=>$model,
                        'columns' =>getMentorColumns($model) ));
?>
