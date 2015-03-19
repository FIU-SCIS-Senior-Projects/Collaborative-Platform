<?php
$this->breadcrumbs=array('Utilization Dashboard');
Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}");
?>
<style> 
    .dashItem{ height:100%; width:100%} 
    .chartCont{ overflow:auto; width:100%; height:450px; border:1px solid #666;}
    
    .panel {background-color: #fff;  border: 1px solid transparent;}
    
</style>
<?php $form = $this->beginWidget('CActiveForm', 
                                  array('action' => Yii::app()->createUrl($this->route),
                                       'method' => 'post',
                                       'id'=> 'dashboarForm')); ?>


<table class="dashItem">
    <td style="vertical-align:top; width:225px;">
        <div id="filterRegion" style="overflow:auto; padding-right:30px">
			<div>
				 <?php 
							 echo $form->labelEx($filter,'reportTypeId'); 
							 echo CHtml::activeDropDownList($filter,
															'reportTypeId',
															 ReportType::getReportTypes() );?>
			</div>
			<div>
				<?php echo $form->labelEx($filter, 'dim2ID');
							  echo CHtml::activeDropDownList($filter,
															 'dim2ID',
															 array(0 => " "));?> 
				
			</div>
			<div>
				<?php echo CHtml::activeLabel($filter,'fromDate');
							 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
									'model' => $filter,          
									'attribute' => 'fromDate',
									'name' => 'fromDate',
									'options'=>array(
										'changeMonth'=>'true',
										'changeYear' =>'true',
										'showButtonPanel' => 'true')
							   ));
					  ?>
			</div>
			<div>
				 <?php echo CHtml::activeLabel($filter,'toDate'); 
						  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
									'model' => $filter,          
									'attribute' => 'toDate',
									'name' => 'toDate',
									'options'=>array(
										'changeMonth'=>'true',
										'changeYear' =>'true',
										'showButtonPanel' => 'true')));?> 
			</div>
			<div>
				<?php echo CHtml::activeLabel($filter,'agregatedDomainID'); 
							  echo CHtml::activeDropDownList($filter,
															'agregatedDomainID',
															CHtml::listData(Domain::model()->findAll(),'id', 'name'),
															array('empty'=>' '));?>
			</div>
			<div>
				<?php 
							 $domainID = $filter->agregatedDomainID;
								 if (isset($domainID) && $domainID > 0 )
								 {
										$subdomain = SubDomain::model()->findAllByAttributes(array('domain_id'=>$domainID));
								 }else
								 {
										$subdomain = array();
								 }
							  echo CHtml::activeLabel($filter,'subdomainID'); 
							  echo CHtml::activeDropDownList($filter, 
															 'subdomainID',
															 CHtml::listData($subdomain,'id', 'name'),
															 array('empty'=>' '));?>
			</div>
			<div>
				<?php echo CHtml::activeLabel($filter,'exclusiveDomainID'); 
					  echo CHtml::activeDropDownList($filter,
													'exclusiveDomainID',
													CHtml::listData(Domain::model()->findAll(),'id', 'name'),
													array('empty'=>' '));?>
			</div>
			<div>
				<?php echo CHtml::activeLabel($filter,'assigned_domain_mentor_id'); 
					  echo CHtml::activeDropDownList($filter,
													 'assigned_domain_mentor_id',
													 CHtml::listData(User::model()->findAllDomainMentors(),'id', 'FullName'),
													 array('empty'=>' '));?>
			</div> 
			<div>
				<?php echo CHtml::activeLabel($filter,'assigned_project_id'); 
					  echo CHtml::activeDropDownList($filter,
													 'assigned_project_id',
													 CHtml::listData(Project::model()->findAllProjects(), 'id', 'title'),
													 array('empty'=>' '));?>
			</div>            
			<div>
				<?php echo CHtml::activeLabel($filter,'assigned_project_mentor_id'); 
					  echo CHtml::activeDropDownList($filter,
													 'assigned_project_mentor_id',
													 CHtml::listData(User::model()->findAllProjectMentors(),'id', 'FullName'),
													 array('empty'=>' '));?>
			</div>
			<div>
				<?php echo CHtml::activeLabel($filter,'assigned_personal_mentor_id'); 
					  echo CHtml::activeDropDownList($filter,
													 'assigned_personal_mentor_id',
													 CHtml::listData(User::model()->findAllPersonalMentors(),'id', 'FullName'),
													 array('empty'=>' '));?>
			</div> 
			<div>
				<?php echo CHtml::activeLabel($filter,'mentee_id'); 
					  echo CHtml::activeDropDownList($filter,
													 'mentee_id',
													 array(),
													 array('empty'=>' '));?>
			</div>
			
       </div>
    </td>
    <td style="vertical-align:top;">
        <div id="chartSection" class="chartCont"></div>
    </td>
</table>
<script>
    
    
$( document ).ready(function() 
{ 

    var chartRegionHeight = $('.navbar-inner').height();
    chartRegionHeight += $('.breadcrumbs').height();  
	chartRegionHeight += 120; 
	chartRegionHeight =  $( window ).height()  - chartRegionHeight;
    $('#filterRegion').height(chartRegionHeight);
	$('#chartSection').height(chartRegionHeight);
	
     
    var chartRegionWidth =  $('.container').width();
    chartRegionWidth = chartRegionWidth - 225 - 30;
    
    if (chartRegionWidth < 600)
    {
        chartRegionWidth = 600;
    }
    
    $('#chartSection').width(chartRegionWidth);
    

 
    
    
    var enumReportType = {
         TicketsCreated:1,
         TicketsClosed:2, 
         
        properties: {
                1: {name: "Amount of Tickets Created"},
                2: {name: "Amount of Tickets Closed"},
        }
         
    };  
    
    var DimensionType = {
      Date:1,
      Year:2,
      MonthOfTheYear:3,
      TicketAssignedMentor:4,
      
      properties: {
        1: {name: "Day", value: 1, format:"dd MMM yyyy"},
        2: {name: "Year", value: 2, format:"yyyy"},
        3: {name: "Month", value: 3, format:"MMM yyyy"},
        4: {name: "Assigned Mentor", value: 4, format:""}
      },    
      
      
     isTimeDimension: function(dimType) 
     {
       return (dimType == DimensionType.Date || dimType == DimensionType.Year || dimType == DimensionType.MonthOfTheYear) ;
     }
     
    };
    

    
   function showParentDiv(selector, blnShow)
   {
      var displayValue = "none";
	  if (blnShow == true )
	  {
	    displayValue = "table-row";
	  }
      $(selector).parent('div').css("display", displayValue);
   } 
   
   function clearInputContent(selector)
   {
      $(selector).val('');
   }
   
   function clearAndHideFilters()
   {
        showParentDiv("#fromDate",false);
        clearInputContent("#fromDate");
       
        showParentDiv("#toDate",false);
        clearInputContent("#toDate");
        
        showParentDiv("#UtilizationDashboardFilter_exclusiveDomainID",false);
        clearInputContent("#UtilizationDashboardFilter_exclusiveDomainID");
        
        showParentDiv("#UtilizationDashboardFilter_agregatedDomainID",false);
        clearInputContent("#UtilizationDashboardFilter_agregatedDomainID");
        
        showParentDiv("#UtilizationDashboardFilter_subdomainID",false);
        clearInputContent("#UtilizationDashboardFilter_subdomainID");
        
        showParentDiv("#UtilizationDashboardFilter_assigned_domain_mentor_id",false);
        clearInputContent("#UtilizationDashboardFilter_assigned_domain_mentor_id");
        
        showParentDiv("#UtilizationDashboardFilter_assigned_project_mentor_id",false);
        clearInputContent("#UtilizationDashboardFilter_assigned_project_mentor_id");
        
        showParentDiv("#UtilizationDashboardFilter_assigned_personal_mentor_id",false);
        clearInputContent("#UtilizationDashboardFilter_assigned_personal_mentor_id");
        
        showParentDiv('#UtilizationDashboardFilter_assigned_project_id',false);
        clearInputContent("#UtilizationDashboardFilter_assigned_project_id");
        
        showParentDiv('#UtilizationDashboardFilter_mentee_id',false);
        clearInputContent("#UtilizationDashboardFilter_mentee_id");
       
   }
   
   function showTicketCountChartFilters()
   {
        showParentDiv("#fromDate",true);
        showParentDiv("#toDate",true);
        showParentDiv("#UtilizationDashboardFilter_exclusiveDomainID",true);
        showParentDiv("#UtilizationDashboardFilter_agregatedDomainID",true);
        showParentDiv("#UtilizationDashboardFilter_assigned_domain_mentor_id", true);
        showParentDiv("#UtilizationDashboardFilter_assigned_project_mentor_id", true);
        showParentDiv("#UtilizationDashboardFilter_assigned_personal_mentor_id", true);
        showParentDiv('#UtilizationDashboardFilter_assigned_project_id', true);
        showParentDiv('#UtilizationDashboardFilter_mentee_id',true);
   }
   
   clearAndHideFilters();

    
    function generateTicketCountDim2Select(dim2IdElement)
    {
        dim2IdElement.append('<option value="' +DimensionType.Date + '">' +  DimensionType.properties[DimensionType.Date].name +'</option>'); 
        dim2IdElement.append('<option value="' +DimensionType.Year + '">' +  DimensionType.properties[DimensionType.Year].name +'</option>');  
        dim2IdElement.append('<option value="' +DimensionType.MonthOfTheYear + '">' +  DimensionType.properties[DimensionType.MonthOfTheYear].name +'</option>'); 
        dim2IdElement.append('<option value="' +DimensionType.TicketAssignedMentor + '">' +  DimensionType.properties[DimensionType.TicketAssignedMentor].name +'</option>'); 
    }
    
    $('#UtilizationDashboardFilter_reportTypeId').on('change', function(){
        
        var dim2IdElement = $('#UtilizationDashboardFilter_dim2ID');
        dim2IdElement.html("");
        dim2IdElement.append('<option value="0"> </option>'); 
        var reportID = parseInt($(this).val());
                
        switch(reportID) 
        {
           case enumReportType.TicketsCreated:
               generateTicketCountDim2Select(dim2IdElement);
            break;
          case enumReportType.TicketsClosed:
               generateTicketCountDim2Select(dim2IdElement);         
            break;
           default: 
               clearAndHideFilters();
        }
        
    });
   
    $('#UtilizationDashboardFilter_dim2ID').on('change', function(){
   
        var intSelectedDimID = 0;
        var oSelectedDim = $(this).val();
        if (!isNaN(oSelectedDim))
        {
          intSelectedDimID = parseInt(oSelectedDim);  
          if (isNaN(intSelectedDimID))
          {
            intSelectedDimID = 0;  
          }
        }
        
        if (intSelectedDimID == 0)
        {
            clearAndHideFilters();            
        }else
        {
            
           var reportID = parseInt($(this).val());
           switch(reportID) 
           {
               case enumReportType.TicketsCreated:
                 showTicketCountChartFilters();
                break;
              case enumReportType.TicketsClosed:
                 showTicketCountChartFilters();        
                break;
               default:      
           }            
        } 
    });
    
    function getInputValueToInt(inputSelector)
    {
         var intValue = 0;
         var oValue = $(inputSelector).val();
         if (!isNaN(oValue) && oValue != null)
         {
             intValue = parseInt(oValue);
             if (isNaN(intValue))
             {
                intValue = 0;
             }
         }        
        return intValue;
    }
    
    $('#UtilizationDashboardFilter_exclusiveDomainID, #UtilizationDashboardFilter_agregatedDomainID').on('change', function(){
    
       var domainAggregatedID =  getInputValueToInt('#UtilizationDashboardFilter_agregatedDomainID');  //parsetInt($('#UtilizationDashboardFilter_agregatedDomainID').val());
       var domainExclusiveID = getInputValueToInt('#UtilizationDashboardFilter_exclusiveDomainID'); 
       if (domainAggregatedID == 0 && domainExclusiveID == 0)
       {
        showParentDiv("#UtilizationDashboardFilter_subdomainID",false);
        showParentDiv("#UtilizationDashboardFilter_agregatedDomainID",true);
        showParentDiv("#UtilizationDashboardFilter_exclusiveDomainID",true);
        clearInputContent("#UtilizationDashboardFilter_subdomainID");          
       }else if(domainAggregatedID > 0)
       {
        
        showParentDiv("#UtilizationDashboardFilter_subdomainID",true);
        showParentDiv("#UtilizationDashboardFilter_exclusiveDomainID",false);
        clearInputContent("#UtilizationDashboardFilter_exclusiveDomainID");  
       }else
      {
        showParentDiv("#UtilizationDashboardFilter_subdomainID",false);
        showParentDiv("#UtilizationDashboardFilter_agregatedDomainID",false);
        clearInputContent("#UtilizationDashboardFilter_agregatedDomainID");    
        clearInputContent("#UtilizationDashboardFilter_subdomainID");  
      }
    });  
    
    $('#UtilizationDashboardFilter_subdomainID, #UtilizationDashboardFilter_agregatedDomainID').on('change', function(){
        
        var domainID = $('#UtilizationDashboardFilter_agregatedDomainID').val();
        var subDomainID = $('#UtilizationDashboardFilter_subdomainID').val();
        
        if (subDomainID != null && subDomainID> 0)
        {
            
            //domain mentor select
            var domainMentorSelect = $('#UtilizationDashboardFilter_assigned_domain_mentor_id');
            domainMentorSelect.html("");
            domainMentorSelect.append('<option value="0"> </option>'); 
            $.post('/coplat/index.php/User/UsersBySubDomainID/' + subDomainID, {}, function(users){
            for(var i = 0; i < users.length; i++) 
            {
                   var user = users[i];
                   domainMentorSelect.append("<option value=\""+user.id+"\">"+user.FullName+"</option>");
            }
            }, 'json');
            
            //mentee select
            var menteeSelect = $('#UtilizationDashboardFilter_mentee_id');
            menteeSelect.html("");
            menteeSelect.append('<option value="0"> </option>'); 
            $.post('/coplat/index.php/User/MenteeBySubdomainID/' + subDomainID, {}, function(users){
            for(var i = 0; i < users.length; i++) 
            {
                   var user = users[i];
                   menteeSelect.append("<option value=\""+user.id+"\">"+user.FullName+"</option>");
            }
            }, 'json');
            
            
            
        }else if (domainID != null && domainID > 0)
        {
            var subDomSelect = $('#UtilizationDashboardFilter_subdomainID'); 
            subDomSelect.html("");
            subDomSelect.append('<option value="0"> </option>'); 
            
            $.post('/coplat/index.php/Subdomain/SubdomainsByDomainID/', {domain: domainID}, function(domains){
              for(var i = 0; i < domains.length; i++) 
              {
                   var domain = domains[i];
                   subDomSelect.append("<option value=\""+domain.id+"\">"+domain.name+"</option>");
              }
           }, 'json');
           
           var domainMentorSelect = $('#UtilizationDashboardFilter_assigned_domain_mentor_id');
           domainMentorSelect.html("");
           domainMentorSelect.append('<option value="0"> </option>');
           $.post('/coplat/index.php/User/UsersByDomainIDAggregated/' + domainID, {}, function(users){
              for(var i = 0; i < users.length; i++) 
              {
                   var user = users[i];
                   domainMentorSelect.append("<option value=\""+user.id+"\">"+user.FullName+"</option>");
              }
           }, 'json');      
           
           
           //mentee select
            var menteeSelect = $('#UtilizationDashboardFilter_mentee_id');
            menteeSelect.html("");
            menteeSelect.append('<option value="0"> </option>'); 
            $.post('/coplat/index.php/User/MenteeByDomainID/' + domainID, {}, function(users){
            for(var i = 0; i < users.length; i++) 
            {
                   var user = users[i];
                   menteeSelect.append("<option value=\""+user.id+"\">"+user.FullName+"</option>");
            }
            }, 'json');
           
        }else
        {
           var subDomSelect = $('#UtilizationDashboardFilter_subdomainID'); 
           subDomSelect.html("");
           subDomSelect.append('<option value="0"> </option>');
           
           var domainMentorSelect = $('#UtilizationDashboardFilter_assigned_domain_mentor_id');
           domainMentorSelect.html("");
           domainMentorSelect.append('<option value="0"> </option>');  
           
            //mentee select
            var menteeSelect = $('#UtilizationDashboardFilter_mentee_id');
            menteeSelect.html("");
            menteeSelect.append('<option value="0"> </option>'); 
           
            $.post('/coplat/index.php/User/AllDomainMentors/', {}, function(users){
            for(var i = 0; i < users.length; i++) 
            {
              var user = users[i];
              domainMentorSelect.append("<option value=\""+user.id+"\">"+user.FullName+"</option>");
            }
            }, 'json');
        }
        
    });
    
     $('#UtilizationDashboardFilter_exclusiveDomainID').on('change', function(){
          
                
         var domainMentorSelect = $('#UtilizationDashboardFilter_assigned_domain_mentor_id');
         domainMentorSelect.html("");
         domainMentorSelect.append('<option value="0"> </option>'); 
         
            //mentee select
        var menteeSelect = $('#UtilizationDashboardFilter_mentee_id');
        menteeSelect.html("");
        menteeSelect.append('<option value="0"> </option>'); 

            var domainID = $(this).val();
            if(domainID != null && domainID > 0) 
            {
              
               $.post('/coplat/index.php/User/UsersByDomainIDExclusive/' + domainID, {}, function(users){
                   for(var i = 0; i < users.length; i++) 
                   {
                        var user = users[i];
                        domainMentorSelect.append("<option value=\""+user.id+"\">"+user.FullName+"</option>");
                   }
                }, 'json');
                
                
               $.post('/coplat/index.php/User/MenteeByDomainID/' + domainID, {}, function(users){
                    for(var i = 0; i < users.length; i++) 
                    {
                       var user = users[i];
                       menteeSelect.append("<option value=\""+user.id+"\">"+user.FullName+"</option>");
                    }
                }, 'json');
                
             }else
             {
                   $.post('/coplat/index.php/User/AllDomainMentors/', {}, function(users){
                         for(var i = 0; i < users.length; i++) 
                         {
                              var user = users[i];
                              domainMentorSelect.append("<option value=\""+user.id+"\">"+user.FullName+"</option>");
                         }
                         }, 'json');            
             }
          
          
      });
     
     
    function isValidDate(str)
    {
       var dateParsed = Date.parse(str);
       return !isNaN(dateParsed);
     }
     
    function validChartParams()
     {
         var dim2Id = getInputValueToInt('#UtilizationDashboardFilter_dim2ID') ;
         var reportID = getInputValueToInt('#UtilizationDashboardFilter_reportTypeId');
         
         if (dim2Id == 0 || reportID == 0)
         {
             return false;
         }
         
         var helperVal = $('#fromDate').val();
         if (helperVal != '' &&  !isValidDate(helperVal))
         {
             logErrorMessage("Invalid From Date value");
             return  false;
         }
         
         helperVal = $('#toDate').val();
         if (helperVal != "" &&  !isValidDate(helperVal))
         {
             logErrorMessage("Invalid To Date value");
             return false;
         }
          
         return true;
     }
     
     function logErrorMessage(errorMessage)
     {
         $('#chartSection').append("<div class='errorMessage'>" + errorMessage + "<div>");
     }
     
     
     $('#UtilizationDashboardFilter_agregatedDomainID, #UtilizationDashboardFilter_subdomainID, \n\
        #UtilizationDashboardFilter_exclusiveDomainID, #UtilizationDashboardFilter_dim2ID, \n\
        #UtilizationDashboardFilter_reportTypeId, #fromDate, #toDate, \n\
        #UtilizationDashboardFilter_assigned_domain_mentor_id, #UtilizationDashboardFilter_assigned_project_mentor_id, \n\
        #UtilizationDashboardFilter_assigned_personal_mentor_id, #UtilizationDashboardFilter_assigned_project_id,\n\
        #UtilizationDashboardFilter_mentee_id').on('change', function(){
         $('#chartSection').html("");
         if (validChartParams())
         {
           //retrieve the data
           var dashboardAction;
           var dim2Id = getInputValueToInt('#UtilizationDashboardFilter_dim2ID');
           var reportID = getInputValueToInt('#UtilizationDashboardFilter_reportTypeId');
           switch(reportID) 
           {              
               case enumReportType.TicketsCreated:
                   dashboardAction = "PullTicketsCreated";
                break;
               case enumReportType.TicketsClosed:
                   dashboardAction = "PullTicketsClosed";                  
                break;             
            }
            
            $('#chartSection').html("<div style='text-align: center;'>Loading chart data please wait<div>\n\
                                    <img src='/coplat/images/ajax-loader.gif'>");
                                                        
           $.post('/coplat/index.php/utilizationDashboard/' + dashboardAction, 
                $('#dashboarForm').serialize(),
                function(data)
                {
                  $('#chartSection').html("");
                  generateDashboardData(eval(data.dashboardData),
                                        reportID,
                                        dim2Id);
                },
                'json').fail(function() {
                    $('#chartSection').html("");
                    logErrorMessage("Server Request error.");
                 });
         }
     });
     
     function generateDashboardData(dashboardData, reportID, dim2Id)
     {
           var chartDataTable = new google.visualization.DataTable();
           if (DimensionType.isTimeDimension(dim2Id))
           { 
               chartDataTable.addColumn('date');               
           }else if(DimensionType.TicketAssignedMentor)
           {
               chartDataTable.addColumn('string');   
           }
           
           
           if(reportID == enumReportType.TicketsCreated || reportID == enumReportType.TicketsClosed )
           {
                chartDataTable.addColumn('number');
           }    
           chartDataTable.addRows(dashboardData);
           var chartWidth = chartRegionWidth -8;
           var options = {  
                   width:chartWidth,
                   height: 300,
                   legend: 'none',
                   bar: {groupWidth: 10},
                   title: enumReportType.properties[reportID].name + ' per ' + DimensionType.properties[dim2Id].name,
                        hAxis: {
                          title: DimensionType.properties[dim2Id].name,
                          format: DimensionType.properties[dim2Id].format,
                        },
                        vAxis: {
                          title: enumReportType.properties[reportID].name
                        }
            };
            
            var chart = new google.visualization.ColumnChart(document.getElementById('chartSection'));
            chart.draw(chartDataTable, options);

     }
   
});
      
         
</script
<?php $this->endWidget(); ?>








