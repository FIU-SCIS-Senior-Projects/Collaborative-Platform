<?php
$this->breadcrumbs=array('Mentee Report');
?>
<h2>Mentee Report</h2>
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
      function getMenteColumns($model)
      {
          $columns = array();
          
          //mentee userID
          $menteeUserID =  array('name'  => 'UserID',
                                 'header'=> 'Mentee User ID',
                                 'filter'=> CHtml::activeNumberField($model, 'UserID'),
                                 'headerHtmlOptions' => array('width'=>'75', ));
          $columns[] = $menteeUserID;
          
         //menteeName
          $menteeName =  array('name'  => 'Name',
                                'header'=> 'Mentee Name',
                                'filter'=> CHtml::activeTextField ($model, 'Name'),
                                'headerHtmlOptions' => array('width'=>'200', ));
         $columns[] = $menteeName;
         
         //menteeEmail
         $menteeEmail =  array('name'  => 'Email',
                              'header'=> 'Mentee Email',
                              'filter'=> CHtml::activeEmailField($model, 'Email'),
                              'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $menteeEmail;
         
         //menteeUserName
         $menteeUserName =  array('name'  => 'UserName',
                             'header'=> 'Mentee User Name',
                             'filter'=> CHtml::activeTextField($model, 'UserName'),
                             'headerHtmlOptions' => array('width'=>'100', ));
         $columns[] = $menteeUserName;
         
         
         //menteeDisabled
         $menteeDisabled = array('name'  => 'Disabled',
                                 'header'=> 'Mentee Disabled',
                                 'value' => 'ReportUtils::getZeroOneToYesNo($data->Disabled)',
                                 'filter'=> array('1'=>'Yes','0'=>'No'),
                                 'headerHtmlOptions' => array('width'=>'100', ));
         $columns[] = $menteeDisabled;
         
         
        //UniversityName
         $universityName = array('name'  => 'UniversityName',
                                 'header'=> 'Mentee University',
                                 'filter'=> CHtml::activeDropDownList($model,
                                                                      'UniversityID',
                                                                       CHtml::listData(University::model()->findAll(),'id', 'name'),
                                                                       array('empty'=>' ')),
                                 'headerHtmlOptions' => array('width'=>'220', ));
         $columns[] = $universityName;
         
        //PersonalMentorID
         $PersonalMentorID = array('name'  => 'PersonalMentorID',
                                     'header'=> 'Personal Mentor (ID)',
                                     'filter'=> CHtml::activeNumberField($model, 'PersonalMentorID'),
                                     'headerHtmlOptions' => array('width'=>'100', ));
         $columns[] = $PersonalMentorID;
         
        //PersonalMentorName
         $PersonalMentorName = array('name'  => 'PersonalMentorName',
                                     'header'=> 'Personal Mentor (Name)',
                                     'filter'=> CHtml::activeTextField($model, 'PersonalMentorName'),
                                     'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $PersonalMentorName;
         
        //PersonalMentorEmail
         $PersonalMentorEmail = array('name'  => 'PersonalMentorEmail',
                                    'header'=> 'Personal Mentor (Email)',
                                    'filter'=> CHtml::activeEmailField($model, 'PersonalMentorEmail'),
                                    'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $PersonalMentorEmail;
         
         
        //PersonalMentorDisabled
         $PersonalMentorDisabled = array('name'  => 'PersonalMentorDisabled',
                                         'header'=> 'Personal Mentor (Disabled)',
                                         'value' => 'ReportUtils::getZeroOneToYesNo($data->PersonalMentorDisabled)',
                                         'filter'=> array('1'=>'Yes','0'=>'No'),
                                         'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $PersonalMentorDisabled;
         
        //menteeProjectTitle
         $menteeProjectTitle = array('name'  => 'menteeProjectTitle',
                                     'header'=> 'Project Title',
                                     'filter'=> CHtml::activeDropDownList($model,
                                                                      'menteeProjectID',
                                                                       CHtml::listData(Project::model()->findAll(),'id', 'title'),
                                                                       array('empty'=>' ')),
                                     'headerHtmlOptions' => array('width'=>'300', ));
         $columns[] = $menteeProjectTitle;
         
         
        //menteeProjectStartDate
         $menteeProjectTitle = array('name'  => 'menteeProjectStartDate',
                                     'header'=> 'Project Start Date',
                                     'value'=>'ReportUtils::dateformat($data->menteeProjectStartDate)',
                                     'filter'=> CHtml::activeDateField($model, 'menteeProjectStartDate'),
                                     'headerHtmlOptions' => array('width'=>'160', ));
         $columns[] = $menteeProjectTitle;
         
         //menteeProjectDueDate
         $menteeProjectDueDate = array('name'  => 'menteeProjectDueDate',
                                     'header'=> 'Project Due Date',
                                     'value'=>'ReportUtils::dateformat($data->menteeProjectDueDate)',
                                     'filter'=> CHtml::activeDateField($model, 'menteeProjectDueDate'),
                                     'headerHtmlOptions' => array('width'=>'160', ));
         $columns[] = $menteeProjectDueDate;
         
         
         //menteeProjectCustomerName
         $menteeProjectCustomerName = array('name'  => 'menteeProjectCustomerName',
                                   'header'=> 'Project Customer',
                                   'filter'=> CHtml::activeTextField($model, 'menteeProjectCustomerName'),
                                   'headerHtmlOptions' => array('width'=>'150', ));
         $columns[] = $menteeProjectCustomerName;
         
   
      
          return $columns;
      }

      $this->widget('bootstrap.widgets.TbGridView', 
                    array('id'=>'mente-grid',                          
                          'type'=>'striped condensed',
                          'dataProvider'=> $model->search(),
                          'enablePagination' => false,
                          'filter'=>$model,
                          'columns' =>getMenteColumns($model)));
                          
?>