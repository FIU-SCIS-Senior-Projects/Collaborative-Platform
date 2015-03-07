<?php
$this->breadcrumbs=array('Utilization Dashboard');
Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}");
Yii::app()->clientScript->registerScript('logoFix',
  " google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date');
      data.addColumn('number');
      
      var chartWidth = 500;
      if (data.getNumberOfRows() > 15)
      {
       chartWidth = data.getNumberOfRows() * 35;
      }
      data.addRows(".$newEvents."); 
      var options = {        
        width:chartWidth,
        height: 300,
        legend: 'none',
        title: 'Tickets created by ".UtilizationDashboardFilter::getDescriptionByDateDimension($filter->newTicketsCurrentDimension)."',
        hAxis: {
          title: '".UtilizationDashboardFilter::getDescriptionByDateDimension($filter->newTicketsCurrentDimension)."',
          format: '".UtilizationDashboardFilter::getDateFormatByDimension($filter->newTicketsCurrentDimension)."',

        },
        vAxis: {
          title: 'Amount of tickets created'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('ex0'));

      chart.draw(data, options);
    }
      ",CClientScript::POS_HEAD);
?>

<?php echo CHtml::beginForm();?>

<style> 
    .dashItem{border:1px solid #666;} 
    .chartCont{ overflow:auto; width:500px;}
</style>

<table >
    <tr>
        <td class="dashItem">            
            <div id="ex0" class="chartCont"></div>
            <table>
                <tr>
                    <td><?php echo CHtml::activeLabel($filter,'newTicketsFromDate'); ?></td>
                    <td><?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'model' => $filter,          
                                            'attribute' => 'newTicketsFromDate',
                                            'name' => 'newTicketsFromDate',
                                            'htmlOptions'=> array("style"=>"width:77px;"),
                                            'options' => array('dateFormat' => 'yy-mm-dd')));?>
                    </td>
                    <td><?php echo CHtml::activeLabel($filter,'newTicketsToDate'); ?></td>
                    <td><?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'model' => $filter,          
                                            'attribute' => 'newTicketsToDate',
                                            'name' => 'newTicketsToDate',
                                            'htmlOptions'=> array("style"=>"width:77px;"),
                                            'options' => array('dateFormat' => 'yy-mm-dd')));?>
                    </td>        
                </tr> 
            </table> 
        </td>
        <td>
            
            
        </td> 
    </tr> 
</table>





<?php echo CHtml::endForm(); ?>


