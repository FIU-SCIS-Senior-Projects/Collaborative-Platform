 <?php $form = $this->beginWidget('CActiveForm', 
                                  array('action' => Yii::app()->createUrl($this->route),
                                       'method' => 'post',
                                       'id'=> 'newTicketsForm')); ?>
<script type="text/javascript">

     google.setOnLoadCallback(drawNewTicketsOverTimeChart);    
     var newTicketsData = new google.visualization.DataTable();
     var newTicketChart = null;
     var newTicketDimDesc = '<?php echo DimensionType::getDescriptionByDateDimension($filter->newTicketsCurrentDimension)?>';
     var newTicketDimFormat = '<?php echo DimensionType::getDateFormatByDimension($filter->newTicketsCurrentDimension)?>'
     newTicketsData.addColumn('date');
     newTicketsData.addColumn('number');
     newTicketsData.addRows(<?php echo $newEvents ?>); 
  

    function drawNewTicketsOverTimeChart() {

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
        title: 'Tickets created per ' + newTicketDimDesc,
        hAxis: {
          title: newTicketDimDesc,
          format: newTicketDimFormat,
        },
        vAxis: {
          title: 'Amount of tickets created'
        }
      };
      
      if (newTicketChart == null)
      {
        newTicketChart = new google.visualization.ColumnChart(document.getElementById('newTicketChart'));
      }    
      newTicketChart.draw(newTicketsData, options);
    }

 
</script>
     <div class="dashItem">             
            <table>
                <td>
                    <div id="newTicketChart" class="chartCont"></div>
                </td>
                <td>
                   <table>
			<tr>
                          <td>
                               <?php echo CHtml::activeLabel($filter,'newTicketsFromDate');
   							         $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'model' => $filter,          
                                            'attribute' => 'newTicketsFromDate',
                                            'name' => 'newTicketsFromDate'));
							   ?>
                           </td>                            
                        </tr>
						<tr>
						   <td>
                            <?php echo CHtml::activeLabel($filter,'newTicketsToDate'); 
  							      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'model' => $filter,          
                                            'attribute' => 'newTicketsToDate',
                                            'name' => 'newTicketsToDate'));?> 
							</td> 				
                        </tr> 					
                        <tr>
                            <td>
                                <?php echo CHtml::activeLabel($filter,'newTicketsDomainID'); 
								      echo CHtml::activeDropDownList($filter,
																	'newTicketsDomainID',
																	CHtml::listData(Domain::model()->findAll(),'id', 'name'),
																	array('empty'=>' '));?>
                            </td>
                        </tr>
						<tr>
                            <td>
							  	<?php 
								     $domainID = $filter->newTicketsDomainID;
									 if (isset($domainID) && $domainID > 0 )
									 {
										$subdomain = SubDomain::model()->findAllByAttributes(array('domain_id'=>$domainID));
									 }else
									 {
										$subdomain = array();
									 }
   								      echo CHtml::activeLabel($filter,'newTicketsSubDomainID'); 
   								      echo CHtml::activeDropDownList($filter, 
                                                                                                     'newTicketsSubDomainID',
												     CHtml::listData($subdomain,'id', 'name'),
												     array('empty'=>' '));?>
                           </td>
                        </tr>                        
                        <tr>
                            <td>
                                <label>Time Dimension</label>
                                <?php  echo CHtml::activeDropDownList($filter,
                                                                      'newTicketsCurrentDimension',
                                                                      DimensionType::getDimensions() );?>                                
                            </td>
                        </tr>
                   
                                          
                   </table> 
                </td>
            </table>
        </div>
<script>
    
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
          
         $('#UtilizationDashboardFilter_newTicketsDomainID').on('change', function()
         {
            var subDomSelect = $('#UtilizationDashboardFilter_newTicketsSubDomainID'); 
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
    
      
         $('#newTicketsFromDate, #newTicketsToDate, #UtilizationDashboardFilter_newTicketsDomainID, #UtilizationDashboardFilter_newTicketsSubDomainID, #UtilizationDashboardFilter_newTicketsCurrentDimension').on('change', function(){
           refreshNewTicketsChart();       
         });
</script>
<?php $this->endWidget(); ?>