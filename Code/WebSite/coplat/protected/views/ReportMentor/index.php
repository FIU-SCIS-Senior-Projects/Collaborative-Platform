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

function getMentorColumns()
{
          
    $columns = array();
          
    //ticket ID
    $columns[]  = array('name'  => 'userID',
                        'header'=> 'Mentor User ID',
                        'headerHtmlOptions' => array('width'=>'75', ));
 
    //name
    $columns[] =  array('name'  => 'name',
                        'header'=> 'Mentor Name',
                        'headerHtmlOptions' => array('width'=>'200', ));
   
    //email    
    $columns[] =  array('name'  => 'email',
                        'header'=> 'Mentor Email',
                        'headerHtmlOptions' => array('width'=>'200', ));     
    
    
    //userName
    $columns[] =  array('name'  => 'userName',
                       'header'=> 'Mentor User Name',
                       'headerHtmlOptions' => array('width'=>'150', ));     
    
    //disabled
    $columns[] =  array('name'  => 'disabled',
                       'header'=> 'Mentor Disabled',
                       'value' => 'ReportUtils::getZeroOneToYesNo($data->disabled)',
                       'headerHtmlOptions' => array('width'=>'80', )); 
    
    
    $columns[] =  array('name'  => 'isProjectMentor',
                       'header'=> 'Project Mentor',
                       'value' => 'ReportUtils::getZeroOneToYesNo($data->isProjectMentor)',
                       'headerHtmlOptions' => array('width'=>'80', ));   
    
    $columns[] =  array('name'  => 'isPersonalMentor',
                      'header'=> 'Personal Mentor',
                      'value' => 'ReportUtils::getZeroOneToYesNo($data->isPersonalMentor)',
                      'headerHtmlOptions' => array('width'=>'80', ));     
   
    $columns[] =  array('name'  => 'isDomainMentor',
                     'header'=> 'Domain Mentor',
                     'value' => 'ReportUtils::getZeroOneToYesNo($data->isDomainMentor)',
                     'headerHtmlOptions' => array('width'=>'80', ));    
    
    $columns[] =  array('name'  => 'isJudge',
                    'header'=> 'Judge',
                    'value' => 'ReportUtils::getZeroOneToYesNo($data->isJudge)',
                    'headerHtmlOptions' => array('width'=>'80', ));  
    
    
    $columns[] =  array('name'  => 'isNew',
                    'header'=> 'Is New',
                    'value' => 'ReportUtils::getZeroOneToYesNo($data->isNew)',
                    'headerHtmlOptions' => array('width'=>'80', )); 
    
    $columns[] =  array('name'  => 'isEmployer',
                   'header'=> 'Is Employer',
                   'value' => 'ReportUtils::getZeroOneToYesNo($data->isEmployer)',
                   'headerHtmlOptions' => array('width'=>'80', ));
    
    $columns[] =  array('name'  => 'employer',
                   'header'=> 'Mentor Employer',
                   'headerHtmlOptions' => array('width'=>'200', ));
    
    $columns[] =  array('name'  => 'position',
                   'header'=> 'Mentor Position',
                   'headerHtmlOptions' => array('width'=>'200', ));
    
   $columns[] =  array('name'  => 'fieldOfStudy',
                   'header'=> 'Mentor Field Of Study',
                   'headerHtmlOptions' => array('width'=>'200', ));
   
   $columns[] =  array('name'  => 'degree',
                  'header'=> 'Mentor Degree',
                  'headerHtmlOptions' => array('width'=>'200', ));
   
   $columns[] =  array('name'  => 'gradYear',
                 'header'=> 'Mentor Graduation Year',
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
