<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
$this->breadcrumbs=array('Mentee Report');
?>
<script>
    function getNumFromStr(str)
    {
       var pattern = /[0-9]+/;
       return str.match(pattern);       
    }

   $(function() {

      $(".grid-view .items thead tr th").draggable({ });;

      $(".grid-view .items thead tr th").droppable({

          drop: function (event, ui) {
              var destination = getNumFromStr(this.id);
              var source = getNumFromStr(ui.draggable[0].id);
              $.get("", { sourceColumn: source, destinationColumn: destination });
              location.reload(true);
          }

    });

  });
</script>
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
         padding-top:0px !important;
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

      abstract class MenteeColumns
      {
            const userId = 0;
            const menteeName = 1;
            const menteeEmail = 2;
            const menteeUserName = 3;  
            const menteeDisabled = 4; 
            const menteeUniversityName = 5; 
            const menteePersonalMentorID = 6;
            const menteePersonalMentorName = 7;
            const menteePersonalMentorEmail = 8;
            const menteePersonalMentorDisabled = 9;
            const menteeProjectTitle = 10;
            const menteeProjectStartDate = 11;
            const menteeProjectDueDate = 12;
            const menteeProjectCustomerName = 13;
       }
      
      //return the collumn array order from the session or just generates the array
      function getColumnArrayOrder()
      {
          $columns =  Yii::app()->session['MenteeColumnOrder'];
          if (!isset($columns))
          {
             $columns = array( MenteeColumns::userId,
                                MenteeColumns::menteeName,
                                MenteeColumns::menteeEmail,
                                MenteeColumns::menteeUserName,
                                MenteeColumns::menteeDisabled,
                                MenteeColumns::menteeUniversityName,
                                MenteeColumns::menteePersonalMentorID,
                                MenteeColumns::menteePersonalMentorName,
                                MenteeColumns::menteePersonalMentorEmail,
                                MenteeColumns::menteePersonalMentorDisabled,
                                MenteeColumns::menteeProjectTitle,
                                MenteeColumns::menteeProjectStartDate,
                                MenteeColumns::menteeProjectDueDate,
                                MenteeColumns::menteeProjectCustomerName);            
         }
          
          return $columns;    
      }
      
      //return all the mentee columns that will be rendered by the mentee grid
      function getMenteColumns($model)
      {
          //get or initialize the current column order
          $columnArrayOrder = getColumnArrayOrder();
          
          //only if make a cache of the columns if needed
          if (isset($_GET['sourceColumn']) && isset($_GET['destinationColumn']))
          {
              
              $source = $_GET['sourceColumn'] ;
              $destination = $_GET['destinationColumn'];
              
              
              $sourceIndex = $source[0];
              $destIndex   = $destination[0];
              
              ReportUtils::moveColumnsByIndex($sourceIndex,$destIndex,$columnArrayOrder);             
              
              Yii::app()->session['MenteeColumnOrder'] = $columnArrayOrder;
          }
                 
           
          //Now render the columns
          $columns = array();
          
          for ($i = 0; $i < count($columnArrayOrder); $i++ )
          {
              
              switch ($columnArrayOrder[$i]) 
              {
                  
                  case MenteeColumns::userId:
                      
                      $menteeUserID =  array('name'  => 'UserID',
                                'header'=> 'Mentee User ID',
                                'filter'=> CHtml::activeNumberField($model, 'UserID'),
                                'headerHtmlOptions' => array('width'=>'75', ));
                      $columns[] = $menteeUserID;

                      break;
                  case MenteeColumns::menteeName:
                      
                      $menteeName =  array('name'  => 'Name',
                              'header'=> 'Mentee Name',
                              'filter'=> CHtml::activeTextField ($model, 'Name'),
                              'headerHtmlOptions' => array('width'=>'200', ));
                      $columns[] = $menteeName;

                      break;
                  case MenteeColumns::menteeEmail:
                      
                      $menteeEmail =  array('name'  => 'Email',
                            'header'=> 'Mentee Email',
                            'filter'=> CHtml::activeEmailField($model, 'Email'),
                            'headerHtmlOptions' => array('width'=>'150', ));
                      $columns[] = $menteeEmail;

                      break;
                  case MenteeColumns::menteeUserName:
                      
                      $menteeUserName =  array('name'  => 'UserName',
                            'header'=> 'Mentee User Name',
                            'filter'=> CHtml::activeTextField($model, 'UserName'),
                            'headerHtmlOptions' => array('width'=>'100', ));
                      $columns[] = $menteeUserName;

                      break;
                  case MenteeColumns::menteeDisabled:
                      
                      $menteeDisabled = array('name'  => 'Disabled',
                                'header'=> 'Mentee Disabled',
                                'value' => 'ReportUtils::getZeroOneToYesNo($data->Disabled)',
                                'filter'=> array('1'=>'Yes','0'=>'No'),
                                'headerHtmlOptions' => array('width'=>'100', ));
                      $columns[] = $menteeDisabled;

                      break;
                  case MenteeColumns::menteeUniversityName:
                      
                      $universityName = array('name'  => 'UniversityName',
                                'header'=> 'Mentee University',
                                'filter'=> CHtml::activeDropDownList($model,
                                                                     'UniversityID',
                                                                      CHtml::listData(University::model()->findAll(),'id', 'name'),
                                                                      array('empty'=>' ')),
                                'headerHtmlOptions' => array('width'=>'220', ));
                      $columns[] = $universityName;

                      break;
                  case MenteeColumns::menteePersonalMentorID:

                      $PersonalMentorID = array('name'  => 'PersonalMentorID',
                                     'header'=> 'Personal Mentor (ID)',
                                     'filter'=> CHtml::activeNumberField($model, 'PersonalMentorID'),
                                     'headerHtmlOptions' => array('width'=>'100', ));
                      $columns[] = $PersonalMentorID;
                      
                      break;
                  case MenteeColumns::menteePersonalMentorName:
                      
                      $PersonalMentorName = array('name'  => 'PersonalMentorName',
                                     'header'=> 'Personal Mentor (Name)',
                                     'filter'=> CHtml::activeTextField($model, 'PersonalMentorName'),
                                     'headerHtmlOptions' => array('width'=>'150', ));
                      $columns[] = $PersonalMentorName;

                      break;
                  case MenteeColumns::menteePersonalMentorEmail:
                      
                      $PersonalMentorEmail = array('name'  => 'PersonalMentorEmail',
                                    'header'=> 'Personal Mentor (Email)',
                                    'filter'=> CHtml::activeEmailField($model, 'PersonalMentorEmail'),
                                    'headerHtmlOptions' => array('width'=>'150', ));
                      $columns[] = $PersonalMentorEmail;

                      break;
                  case MenteeColumns::menteePersonalMentorDisabled:
                      $PersonalMentorDisabled = array('name'  => 'PersonalMentorDisabled',
                                                               'header'=> 'Personal Mentor (Disabled)',
                                                               'value' => 'ReportUtils::getZeroOneToYesNo($data->PersonalMentorDisabled)',
                                                               'filter'=> array('1'=>'Yes','0'=>'No'),
                                                               'headerHtmlOptions' => array('width'=>'150', ));
                      $columns[] = $PersonalMentorDisabled;
                      
                      
                      break;
                  case MenteeColumns::menteeProjectTitle:
                      $menteeProjectTitle = array('name'  => 'menteeProjectTitle',
                                    'header'=> 'Project Title',
                                    'filter'=> CHtml::activeDropDownList($model,
                                                                     'menteeProjectID',
                                                                      CHtml::listData(Project::model()->findAll(),'id', 'title'),
                                                                      array('empty'=>' ')),
                                    'headerHtmlOptions' => array('width'=>'300', ));
                      $columns[] = $menteeProjectTitle;

                      break;
                  case MenteeColumns::menteeProjectStartDate:
                      
                      $menteeProjectTitle = array('name'  => 'menteeProjectStartDate',
                                    'header'=> 'Project Start Date',
                                    'value'=>'ReportUtils::dateformat($data->menteeProjectStartDate)',
                                    'filter'=> CHtml::activeDateField($model, 'menteeProjectStartDate'),
                                    'headerHtmlOptions' => array('width'=>'160', ));
                      $columns[] = $menteeProjectTitle;

                      break;

                  case MenteeColumns::menteeProjectDueDate:
                      
                      $menteeProjectDueDate = array('name'  => 'menteeProjectDueDate',
                                     'header'=> 'Project Due Date',
                                     'value'=>'ReportUtils::dateformat($data->menteeProjectDueDate)',
                                     'filter'=> CHtml::activeDateField($model, 'menteeProjectDueDate'),
                                     'headerHtmlOptions' => array('width'=>'160', ));
                      $columns[] = $menteeProjectDueDate;

                      break;
                  case MenteeColumns::menteeProjectCustomerName:
                      
                      $menteeProjectCustomerName = array('name'  => 'menteeProjectCustomerName',
                                   'header'=> 'Project Customer',
                                   'filter'=> CHtml::activeTextField($model, 'menteeProjectCustomerName'),
                                   'headerHtmlOptions' => array('width'=>'150', ));
                      $columns[] = $menteeProjectCustomerName;

                      break; 
              }         
          }
      
          return $columns;
      }

      
      ///here render the grid view
      $this->widget('bootstrap.widgets.TbGridView', 
                    array('id'=>'mente-grid', 
                          'ajaxUpdate'=>false,
                          'type'=>'striped condensed',
                          'template' => '{items}{summary}',
                          'dataProvider'=> $model->search(),
                          'enablePagination' => false,
                          'filter'=>$model,
                          'columns' =>getMenteColumns($model)));
                          
?>