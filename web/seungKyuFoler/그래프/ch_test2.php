

<!DOCTYPE html>
<html lang="en" dir="ltr">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="jquery-1.3.2.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable
        (
          [
          ['Month', '강수량', '평균기온'],
          ['1월',  17.31,   -3.99 ],
          ['2월',  23.56, -1.23],
          ['3월',  29.94, 4.26],
          ['4월',  72.50,  10.10],
          ['5월',  57.00,  15.78],
          ['6월',  76.81, 22.63],
          ['7월',  407.81, 25.14],
          ['8월',  173.44,  22.22],
          ['9월',  67.19,  17.20],
          ['10월',  44.75,  11.22],
          ['11월', 50.75,  5.00],
          ['12월', 20.50,  -2.42],

      ]);

    // var options = {
    //   title : '2010년~2017년',
    //   vAxis: {title: 'Cups'},
    //   hAxis: {title: 'Month'},
    //   seriesType: 'bars',
    //   series: {1: {type: 'bars'}}
    //
    // };


          var options = {
              width: 900,
              title: '2010년에서 2017년 까지의 평균기온과 강수량',
      vAxes: {
			0: {
				title: '강수량',

				},
			1: {
				title: '기온',

			},
          },


      series: {

			0:{
				targetAxisIndex:0,
        type: 'bars',
				},
			1:{
				targetAxisIndex:1,

				},
            },
      };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
    </script>

  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
