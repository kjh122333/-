
<!DOCTYPE html>
<html lang="en" dir="ltr">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <head>

    <?php

    // $local= $_GET['local'];
    // $result = $local;

    $option1 = isset($_GET['area1']) ? $_GET['area1'] : false;
    if($option1){
      echo htmlentities($_GET['area1'],ENT_QUOTES,"UTF-8");
    }else {
      echo "지역1날씨안되노";
      exit;
    }

    $option2 = isset($_GET['area2']) ? $_GET['area2'] : false;
    if($option1){
      echo htmlentities($_GET['area2'],ENT_QUOTES,"UTF-8");
    }else {
      echo "지역2날씨안되노";
      exit;
    }

    $option3 = isset($_GET['area3']) ? $_GET['area3'] : false;
    if($option1){
      echo htmlentities($_GET['area3'],ENT_QUOTES,"UTF-8");
    }else {
      echo "지역3날씨안되노";
      exit;
    }



     require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');
     ?>

     <?
       $query = "SELECT * FROM weather_tbl  WHERE area1 = '$option1' AND area2 = '$option2'
       AND area3 = '$option3' ";

/// TEST
       // $query = "SELECT * FROM weather_tbl  WHERE area1 = '$OPT1' AND area2 = '$OPT2' AND area3 = '$OPT3'  ";

              $result = mysql_query($query);

                $data1[] = array('Month', '강수량', '평균기온');
                $i=1;
                while($data = mysql_fetch_array($result)) {
                $data1[] = array($i.'월', (double)$data[precipitation], (double)$data[temparatures]);
                $i++;
                }


     ?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="jquery-1.3.2.js"></script>

    <script type="text/javascript">


      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable
        (

        <?= json_encode($data1) ?>);

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
        ///////////////////////////////////////////////////


      //////////////////////////////////////////////////////////////
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
    </script>
  </head>
  <style type="text/css" media="screen">

  </style>
  <body>




    <div id="chart_div" style="width: 900px; height: 500px;border:1px solid red;float:left; "></div>

    <div class="list" style="float:left; ">


      <table border="1" style="height: 480px;">
          <tr>
            <td>월</td>
            <td>강수량</td>
            <td>기온</td>
          </tr>

          <?php

      ///////////////////////////////////////////////////////
       require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');


        $query2 = "SELECT * FROM weather_tbl  WHERE area1 = '$option1' AND area2 = '$option2'
        AND area3 = '$option3' ";
        $result2 = mysql_query($query2);

      //하나 하나를 while로 간다 (반복문)
       while($data = mysql_fetch_array($result2))  {
        ?>
        <tr>
          <td><?=$data[month]?>월</td>
          <td><?=$data[precipitation]?>mm</td>
          <td><?=$data[temparatures]?>°C</td>
        </tr>
       <?}

      ?>

      </table>
  </div>


  </body>
</html>
