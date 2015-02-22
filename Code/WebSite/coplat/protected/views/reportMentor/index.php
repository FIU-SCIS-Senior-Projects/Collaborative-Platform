<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
$this->breadcrumbs=array('Mentor Report');
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


abstract class MentorColumns
{
    const userID = 0;
    const name = 1;
    const email = 2;
    const userName = 3;
    const disabled = 4;
    const isProjectMentor = 5;
    const isPersonalMentor = 6;
    const isDomainMentor = 7;
    const isJudge = 8;
    const isNew = 9;
    const isEmployer = 10;
    const employer = 11;
    const position = 12;
    const fieldOfStudy = 13;
    const degree = 14;
    const gradYear = 15;

}





//return the collumn array order from the session or just generates the array
function getColumnArrayOrder()
{
    $columns =  Yii::app()->session['MentorColumnOrder'];
    if (!isset($columns))
    {
        
        
        $columns = array(  MentorColumns::userID, 
    MentorColumns::name, 
    MentorColumns::email ,
    MentorColumns::userName,
    MentorColumns::disabled,
    MentorColumns::isProjectMentor,
    MentorColumns::isPersonalMentor,
    MentorColumns::isDomainMentor,
    MentorColumns::isJudge,
    MentorColumns::isNew,
    MentorColumns::isEmployer,
    MentorColumns::employer,
    MentorColumns::position,
    MentorColumns::fieldOfStudy,
    MentorColumns::degree,
    MentorColumns::gradYear,);            
    }
    
    return $columns;    
}

function getMentorColumns($model)
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
        
        Yii::app()->session['MentorColumnOrder'] = $columnArrayOrder;
    }
    
          
    $columns = array();
    
    
    for ($i = 0; $i < count($columnArrayOrder); $i++ )
    {
        
        switch ($columnArrayOrder[$i]) 
        {
            
            case MentorColumns::userID:
               
            
                $columns[]  = array('name'  => 'userID',
                                    'header'=> 'Mentor User ID',
                                    'filter'=> CHtml::activeNumberField($model, 'userID'),
                                    'headerHtmlOptions' => array('width'=>'75', ));
            break;
            
            
            case MentorColumns::name:
                 $columns[] =  array('name'  => 'name',
                            'header'=> 'Mentor Name',
                            'filter'=> CHtml::activeTextField($model, 'name'),
                            'headerHtmlOptions' => array('width'=>'200', ));
        
            break;
        
            case  MentorColumns::email:
                $columns[] =  array('name'  => 'email',
                                    'header'=> 'Mentor Email',
                                    'filter'=> CHtml::activeEmailField ($model, 'email'),
                                    'headerHtmlOptions' => array('width'=>'200', ));     
             break;
        
            case MentorColumns::userName:
                $columns[] =  array('name'  => 'userName',
                                   'header'=> 'Mentor User Name',
                                   'filter'=> CHtml::activeTextField ($model, 'userName'),
                                   'headerHtmlOptions' => array('width'=>'120', ));     
              break;
                            
            case MentorColumns::disabled:
                $columns[] =  array('name'  => 'disabled',
                                   'header'=> 'Mentor Disabled',
                                   'value' => 'ReportUtils::getZeroOneToYesNo($data->disabled)',
                                   'filter'=> array('1'=>'Yes','0'=>'No'),
                                   'headerHtmlOptions' => array('width'=>'80', )); 
                break;
                
                
            case MentorColumns::isProjectMentor:
               $columns[] =  array('name'  => 'isProjectMentor',
                                   'header'=> 'Project Mentor',
                                   'value' => 'ReportUtils::getZeroOneToYesNo($data->isProjectMentor)',
                                   'filter'=> array('1'=>'Yes','0'=>'No'),
                                   'headerHtmlOptions' => array('width'=>'80', ));   
                break;
                
            case MentorColumns::isPersonalMentor:
                $columns[] =  array('name'  => 'isPersonalMentor',
                                    'header'=> 'Personal Mentor',
                                    'value' => 'ReportUtils::getZeroOneToYesNo($data->isPersonalMentor)',
                                    'filter'=> array('1'=>'Yes','0'=>'No'),
                                    'headerHtmlOptions' => array('width'=>'80', ));     
              break;
              
              
            case MentorColumns::isDomainMentor:
              $columns[] =  array('name'  => 'isDomainMentor',
                                 'header'=> 'Domain Mentor',
                                 'value' => 'ReportUtils::getZeroOneToYesNo($data->isDomainMentor)',
                                 'filter'=> array('1'=>'Yes','0'=>'No'),
                                 'headerHtmlOptions' => array('width'=>'80', ));  
               break;
        
            case MentorColumns::isJudge:
                $columns[] =  array('name'  => 'isJudge',
                            'header'=> 'Judge',
                            'value' => 'ReportUtils::getZeroOneToYesNo($data->isJudge)',
                            'filter'=> array('1'=>'Yes','0'=>'No'),
                            'headerHtmlOptions' => array('width'=>'80', ));
                break;
        
            case MentorColumns::isNew:
                $columns[] =  array('name'  => 'isNew',
                        'header'=> 'Is New',
                        'value' => 'ReportUtils::getZeroOneToYesNo($data->isNew)',
                        'filter'=> array('1'=>'Yes','0'=>'No'),
                        'headerHtmlOptions' => array('width'=>'80', )); 
                break;
                
            case MentorColumns::isEmployer:
                 $columns[] =  array('name'  => 'isEmployer',
                       'header'=> 'Is Employer',
                       'value' => 'ReportUtils::getZeroOneToYesNo($data->isEmployer)',
                       'filter'=> array('1'=>'Yes','0'=>'No'),
                       'headerHtmlOptions' => array('width'=>'80', ));
                 break;
                 
            case MentorColumns::employer: 
                 $columns[] =  array('name'  => 'employer',
                       'header'=> 'Mentor Employer',
                       'filter'=> CHtml::activeTextField ($model, 'employer'),
                       'headerHtmlOptions' => array('width'=>'200', ));
                 break;
                 
                 
            case MentorColumns::position:
                $columns[] =  array('name'  => 'position',
                       'header'=> 'Mentor Position',
                       'filter'=> CHtml::activeTextField ($model, 'position'),
                       'headerHtmlOptions' => array('width'=>'200', ));
                break;
                
                
            case MentorColumns::fieldOfStudy:
                $columns[] =  array('name'  => 'fieldOfStudy',
                       'header'=> 'Mentor Field Of Study',
                       'filter'=> CHtml::activeTextField ($model, 'fieldOfStudy'),
                       'headerHtmlOptions' => array('width'=>'200', ));
                break;
                
                
            case  MentorColumns::degree:
                $columns[] =  array('name'  => 'degree',
                      'header'=> 'Mentor Degree',
                       'filter'=> CHtml::activeTextField ($model, 'degree'),
                      'headerHtmlOptions' => array('width'=>'200', ));
                break;
                
                
            case MentorColumns::gradYear:
                $columns[] =  array('name'  => 'gradYear',
                     'header'=> 'Mentor Graduation Year',
                      'filter'=> CHtml::activeNumberField ($model, 'gradYear'),
                     'headerHtmlOptions' => array('width'=>'200', ));
                break;
        }
        
        
        
    }
     
    
   return $columns;
}

    $this->widget('bootstrap.widgets.TbGridView', 
                    array('id'=>'mentor-grid',
                        'ajaxUpdate'=>false,
                        'type'=>'striped condensed',
                        'template' => '{items}{summary}',
                        'dataProvider'=> $model->search(),
                        'enablePagination' => false,
                        'filter'=>$model,
                        'columns' =>getMentorColumns($model) ));
?>
