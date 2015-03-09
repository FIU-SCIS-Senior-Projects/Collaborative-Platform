<?php
$this->breadcrumbs=array('Utilization Dashboard');
Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi");
/*Yii::app()->clientScript->registerScript('logoFix',
  " google.load('visualization', '1', {packages: ['corechart']});
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
      data.addRows(".$newEvents."); 
      var options = {  
        width:chartWidth,
        height: 300,
        legend: 'none',
		bar: {groupWidth: 10},
        title: 'Tickets created per ".DimensionType::getDescriptionByDateDimension($filter->newTicketsCurrentDimension)."',
        hAxis: {
          title: '".DimensionType::getDescriptionByDateDimension($filter->newTicketsCurrentDimension)."',
          format: '".DimensionType::getDateFormatByDimension($filter->newTicketsCurrentDimension)."',
        },
        vAxis: {
          title: 'Amount of tickets created'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('ex0'));

      chart.draw(data, options);
    }
      ",CClientScript::POS_HEAD);*/
?>
<style> 
     form {width:100%}
    .dashItem{border:1px solid #666; height:100%} 
    .chartCont{ overflow:auto; width:630px; height:100%}
</style>
<?php echo  $this->renderPartial('NewTicketsPerOverTime',array('filter'=>$filter,'newEvents'=>$newEvents),false,false); ?>






