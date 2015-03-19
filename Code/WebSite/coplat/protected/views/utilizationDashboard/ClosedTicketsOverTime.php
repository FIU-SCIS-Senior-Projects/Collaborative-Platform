 <?php $form = $this->beginWidget('CActiveForm', 
                                  array('action' => Yii::app()->createUrl($this->route),
                                       'method' => 'post',
                                       'id'=> 'closedTicketsForm')); ?>

<script type="text/javascript">

     google.setOnLoadCallback(drawClosedTicketsOverTimeChart);    
     var closedTicketsData = new google.visualization.DataTable();
     var closedTicketChart = null;
     var closedTicketDimDesc = '<?php echo DimensionType::getDescriptionByDateDimension($filter->closedTicketsCurrentDimension)?>';
     var closedTicketDimFormat = '<?php echo DimensionType::getDateFormatByDimension($filter->closedTicketsCurrentDimension)?>'
     closedTicketsData.addColumn('date');
     closedTicketsData.addColumn('number');
     closedTicketsData.addRows(<?php echo $closedEvents ?>); 
  

    function drawClosedTicketsOverTimeChart() {

      var chartWidth = 600;
     /* if (newTicketsData.getNumberOfRows() > 15)
      {
       chartWidth = newTicketsData.getNumberOfRows() * 35;
      }*/
      var options = {  
        width:chartWidth,
        height: 300,
        legend: 'none',
		bar: {groupWidth: 10},
        title: 'Tickets closed per ' + closedTicketDimDesc,
        hAxis: {
          title: closedTicketDimDesc,
          format: closedTicketDimFormat,
        },
        vAxis: {
          title: 'Amount of tickets closed'
        }
      };
      
      if (closedTicketChart == null)
      {
        closedTicketChart = new google.visualization.ColumnChart(document.getElementById('closedTicketChart'));
      }    
      closedTicketChart.draw(closedTicketsData, options);
    }

 
</script>
<div class="dashItem">             
        <table>
            <td>
                <div id="closedTicketChart" class="chartCont"></div>
            </td>
            <td>
               <table>
                    <tr>
                      <td>
                           <?php echo CHtml::activeLabel($filter,'closedTicketsFromDate');
                                                             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $filter,          
                                        'attribute' => 'closedTicketsFromDate',
                                        'name' => 'closedTicketsFromDate'));
                                                       ?>
                       </td>                            
                    </tr>
                    <tr>
                        <td>
                        <?php echo CHtml::activeLabel($filter,'closedTicketsToDate'); 
                                                          $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $filter,          
                                        'attribute' => 'closedTicketsToDate',
                                        'name' => 'closedTicketsToDate'));?> 
                        </td> 				
                    </tr> 					
                    <tr>
                        <td>
                            <?php echo CHtml::activeLabel($filter,'closedTicketsDomainID'); 
                            echo CHtml::activeDropDownList($filter,'closedTicketsDomainID',
                                                           CHtml::listData(Domain::model()->findAll(),'id', 'name'),
                                                                                                                                    array('empty'=>' '));?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php 
                                 $domainID = $filter->closedTicketsDomainID;
                                     if (isset($domainID) && $domainID > 0 )
                                     {
                                            $subdomain = SubDomain::model()->findAllByAttributes(array('domain_id'=>$domainID));
                                     }else
                                     {
                                            $subdomain = array();
                                     }
                                  echo CHtml::activeLabel($filter,'closedTicketsSubDomainID'); 
                                  echo CHtml::activeDropDownList($filter, 
                                                                 'closedTicketsSubDomainID',
                                                                 CHtml::listData($subdomain,'id', 'name'),
                                                                 array('empty'=>' '));?>
                       </td>
                    </tr>                        
                    <tr>
                        <td>
                            <label>Time Dimension</label>
                            <?php  echo CHtml::activeDropDownList($filter,
                                                                  'closedTicketsCurrentDimension',
                                                                  DimensionType::getDimensions() );?>                                
                        </td>
                    </tr>


               </table> 
            </td>
        </table>
    </div>
<script>
         function refreshClosedTicketsChart()
         {   
          closedTicketsData.removeRows(0, closedTicketsData.getNumberOfRows());
	  $.post('/coplat/index.php/utilizationDashboard/RefreshClosedTickets', 
                 $('#closedTicketsForm').serialize(),
                 function(data){
                     
                    closedTicketDimDesc =  data.dimDesc;
                    closedTicketsData.addRows(eval(data.closedEvents));
                    closedTicketDimFormat = data.dimFormat;
                    drawClosedTicketsOverTimeChart();                    
                },'json');
          }
          
         $('#UtilizationDashboardFilter_closedTicketsDomainID').on('change', function()
         {
            var subDomSelect = $('#UtilizationDashboardFilter_closedTicketsSubDomainID'); 
            subDomSelect.html("");
            subDomSelect.append('<option value=""> </option>'); 
            
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
    
        $('#closedTicketsFromDate, #closedTicketsToDate, #UtilizationDashboardFilter_closedTicketsDomainID, #UtilizationDashboardFilter_closedTicketsSubDomainID, #UtilizationDashboardFilter_closedTicketsCurrentDimension').on('change', function(){
           refreshClosedTicketsChart();       
         });
</script>
<?php $this->endWidget(); ?>

