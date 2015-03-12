<?php
$this->breadcrumbs=array('Utilization Dashboard');
Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}");
?>
<style> 
     form {width:100%}
    .dashItem{ height:100%;} 
    .chartCont{ overflow:auto; width:630px; height:450px; border:1px solid #666;}
</style>
<?php $form = $this->beginWidget('CActiveForm', 
                                  array('action' => Yii::app()->createUrl($this->route),
                                       'method' => 'post',
                                       'id'=> 'newTicketsForm')); ?>
<div class="dashItem">             
<table>
    <td style="vertical-align:top">
       <table>
           <tr>
               <td>
                   <?php 
                         echo $form->labelEx($filter,'reportTypeId'); 
                         echo CHtml::activeDropDownList($filter,
                                                        'reportTypeId',
                                                         ReportType::getReportTypes() );?>
               </td>               
           </tr>
           <tr>
                <td>
                    <?php echo $form->labelEx($filter, 'dim2ID');
                          echo CHtml::activeDropDownList($filter,
                                                         'dim2ID',
                                                         array(0 => " "));?>                                
                </td>
            </tr>           
            <tr>
              <td>
                   <?php echo CHtml::activeLabel($filter,'fromDate');
                         $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $filter,          
                                'attribute' => 'fromDate',
                                'name' => 'fromDate'));
                  ?>
               </td>                            
            </tr>
            <tr>
                <td>
                <?php echo CHtml::activeLabel($filter,'toDate'); 
                      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $filter,          
                                'attribute' => 'toDate',
                                'name' => 'toDate'));?> 
                </td> 				
            </tr> 
            <tr>
                <td>
                    <?php echo CHtml::activeLabel($filter,'agregatedDomainID'); 
                          echo CHtml::activeDropDownList($filter,
                                                        'agregatedDomainID',
                                                        CHtml::listData(Domain::model()->findAll(),'id', 'name'),
                                                        array('empty'=>' '));?>
                </td>
            </tr>
            <tr>
                <td>
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
               </td>
            </tr>
            <tr>
                <td>
                    <?php echo CHtml::activeLabel($filter,'exclusiveDomainID'); 
                          echo CHtml::activeDropDownList($filter,
                                                        'exclusiveDomainID',
                                                        CHtml::listData(Domain::model()->findAll(),'id', 'name'),
                                                        array('empty'=>' '));?>
                </td>
            </tr>        


       </table> 
    </td>
    <td>
        <div id="newTicketChart" class="chartCont"></div>
    </td>
</table>
</div>
<script>
    
    
$( document ).ready(function() 
{ 
    var enumReportType = {
         TicketsCreated:1,
         TicketsClosed:2,         
    };  
    
    var DimensionType = {
      Date:1,
      Year:2,
      MonthOfTheYear:3,
      
      properties: {
        1: {name: "Day", value: 1},
        2: {name: "Year", value: 2},
        3: {name: "Month", value: 3}
      }
    };
    
   function showParentTr(selector, blnShow)
   {
      var displayValue = "none";
	  if (blnShow == true )
	  {
	    displayValue = "table-row";
	  }
      $(selector).parent('td').parent('tr').css("display", displayValue);
   } 
   
   function clearInputContent(selector)
   {
      $(selector).val('');
   }
   
   function clearAndHideFilters()
   {
        showParentTr("#fromDate",false);
        clearInputContent("#fromDate");
       
        showParentTr("#toDate",false);
        clearInputContent("#toDate");
        
        showParentTr("#UtilizationDashboardFilter_exclusiveDomainID",false);
        clearInputContent("#UtilizationDashboardFilter_exclusiveDomainID");
        
        showParentTr("#UtilizationDashboardFilter_agregatedDomainID",false);
        clearInputContent("#UtilizationDashboardFilter_agregatedDomainID");
        
        showParentTr("#UtilizationDashboardFilter_subdomainID",false);
        clearInputContent("#UtilizationDashboardFilter_subdomainID");
       
   }
   
   function showTicketCountChartFilters()
   {
        showParentTr("#fromDate",true);
        showParentTr("#toDate",true);
        showParentTr("#UtilizationDashboardFilter_exclusiveDomainID",true);
        showParentTr("#UtilizationDashboardFilter_agregatedDomainID",true);
      //  showParentTr("#UtilizationDashboardFilter_subdomainID",true);
   }
   
   clearAndHideFilters();

    
    function generateTicketCountDim2Select(dim2IdElement)
    {
        dim2IdElement.append('<option value="' +DimensionType.Date + '">' +  DimensionType.properties[DimensionType.Date].name +'</option>'); 
        dim2IdElement.append('<option value="' +DimensionType.Year + '">' +  DimensionType.properties[DimensionType.Year].name +'</option>');  
        dim2IdElement.append('<option value="' +DimensionType.MonthOfTheYear + '">' +  DimensionType.properties[DimensionType.MonthOfTheYear].name +'</option>'); 
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
        showParentTr("#UtilizationDashboardFilter_subdomainID",false);
        showParentTr("#UtilizationDashboardFilter_agregatedDomainID",true);
        showParentTr("#UtilizationDashboardFilter_exclusiveDomainID",true);
        clearInputContent("#UtilizationDashboardFilter_subdomainID");          
       }else if(domainAggregatedID > 0)
       {
        
        showParentTr("#UtilizationDashboardFilter_subdomainID",true);
        showParentTr("#UtilizationDashboardFilter_exclusiveDomainID",false);
        clearInputContent("#UtilizationDashboardFilter_exclusiveDomainID");  
       }else
      {
        showParentTr("#UtilizationDashboardFilter_subdomainID",false);
        showParentTr("#UtilizationDashboardFilter_agregatedDomainID",false);
        clearInputContent("#UtilizationDashboardFilter_agregatedDomainID");    
        clearInputContent("#UtilizationDashboardFilter_subdomainID");  
      }
    });  
    
    
    $('#UtilizationDashboardFilter_agregatedDomainID').on('change', function(){

       var subDomSelect = $('#UtilizationDashboardFilter_subdomainID'); 
       subDomSelect.html("");
       subDomSelect.append('<option value="0"> </option>'); 

       var domainID = $(this).val();
       if(domainID != null) 
       {
           $.post('/coplat/index.php/Subdomain/SubdomainsByDomainID/', {domain: domainID}, function(domains){
              for(var i = 0; i < domains.length; i++) 
              {
                   var domain = domains[i];
                   subDomSelect.append("<option value=\""+domain.id+"\">"+domain.name+"</option>");
              }
           }, 'json');
       }

     });
 
    
   
});
         function refreshNewTicketsChart()
         {   
          newTicketsData.removeRows(0, newTicketsData.getNumberOfRows());
	  $.post('/coplat/index.php/utilizationDashboard/RefreshNewTickets', 
                 $('#newTicketsForm').serialize(),
                 function(data){
                     
                    newTicketDimDesc =  data.dimDesc;
                    newTicketsData.addRows(eval(data.newEvents));
                    newTicketDimFormat = data.dimFormat;
                    drawNewTicketsOverTimeChart();                    
                },'json');
          }
          
         
    
      
         $('#newTicketsFromDate, #newTicketsToDate, #UtilizationDashboardFilter_newTicketsDomainID, #UtilizationDashboardFilter_newTicketsSubDomainID, #UtilizationDashboardFilter_newTicketsCurrentDimension').on('change', function(){
           refreshNewTicketsChart();       
         });
</script>
<?php $this->endWidget(); ?>








