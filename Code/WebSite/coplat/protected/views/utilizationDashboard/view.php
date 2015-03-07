<?php
$this->breadcrumbs=array('Utilization Dashboard');
Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}");
Yii::app()->clientScript->registerScript('logoFix',
                                         "            google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1],
        [{v: [9, 0, 0], f: '9 am'}, 2],
        [{v: [10, 0, 0], f:'10 am'}, 3],
        [{v: [11, 0, 0], f: '11 am'}, 4],
        [{v: [12, 0, 0], f: '12 pm'}, 5],
        [{v: [13, 0, 0], f: '1 pm'}, 6],
        [{v: [14, 0, 0], f: '2 pm'}, 7],
        [{v: [15, 0, 0], f: '3 pm'}, 8],
        [{v: [16, 0, 0], f: '4 pm'}, 9],
        [{v: [17, 0, 0], f: '5 pm'}, 10],
      ]);

      var options = {
        width: 1000,
        height: 563,
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          gridlines: {count: 10}
        },
        vAxis: {
          title: 'Rating (scale of 1-10)'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('ex0'));

      chart.draw(data, options);
    }
      ",CClientScript::POS_HEAD);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<div id="ex0"></div>
