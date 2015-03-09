 <?php $form = $this->beginWidget('CActiveForm', 
                                  array('action' => Yii::app()->createUrl($this->route),'enableAjaxValidation'=>true,
                                  'method' => 'post')); ?>
<script type="text/javascript">
 google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date');
      data.addColumn('number');
      
      var chartWidth = 600;
      if (data.getNumberOfRows() > 15)
      {
       chartWidth = data.getNumberOfRows() * 35;
      }
      data.addRows(<?php echo $newEvents ?>); 
      var options = {  
        width:chartWidth,
        height: 300,
        legend: 'none',
		bar: {groupWidth: 10},
        title: 'Tickets created per <?php echo DimensionType::getDescriptionByDateDimension($filter->newTicketsCurrentDimension)?>',
        hAxis: {
          title: '<?php DimensionType::getDescriptionByDateDimension($filter->newTicketsCurrentDimension)?>',
          format: '<?php DimensionType::getDateFormatByDimension($filter->newTicketsCurrentDimension)?>',
        },
        vAxis: {
          title: 'Amount of tickets created'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('ex0'));

      chart.draw(data, options);
    }
</script>
     <div class="dashItem">             
            <table>
                <td>
                    <div id="ex0" class="chartCont"></div>
                </td>
                <td>
                   <table>
					   <tr>
                          <td>
                               <?php echo CHtml::activeLabel($filter,'newTicketsFromDate');
   							         $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'model' => $filter,          
                                            'attribute' => 'newTicketsFromDate',
                                            'name' => 'newTicketsFromDate',
                                            'htmlOptions'=> array('submit'=>'')));
							   ?>
                           </td>                            
                        </tr>
						<tr>
						   <td>
                            <?php echo CHtml::activeLabel($filter,'newTicketsToDate'); 
  							      $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'model' => $filter,          
                                            'attribute' => 'newTicketsToDate',
                                            'name' => 'newTicketsToDate',
                                            'htmlOptions'=> array('submit'=>'')));?> 
							</td> 				
                        </tr> 					
                        <tr>
                            <td>
                                <?php echo CHtml::activeLabel($filter,'newTicketsDomainID'); 
								      echo CHtml::activeDropDownList($filter,
																	'newTicketsDomainID',
																	CHtml::listData(Domain::model()->findAll(),'id', 'name'),
																	array('empty'=>' ','submit'=>''));?>
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
																	 array('empty'=>' ', 'submit'=>''));?>
                           </td>
                        </tr>                        
                        <tr>
                            <td>
                                <label>Time Dimension</label>
                                <?php  echo CHtml::activeDropDownList($filter,
                                                                      'newTicketsCurrentDimension',
                                                                      DimensionType::getDimensions(),
																	  array('submit'=>''));?>                                
                            </td>
                        </tr>
                   
                                          
                   </table> 
                </td>
            </table>
        </div>
<?php $this->endWidget(); ?>