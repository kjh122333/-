
<!DOCTYPE html>
<html lang="en" dir="ltr">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <head>
    <!-- 데이블 디자인 -->
    <style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
  .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
  .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
  .tg .tg-rnpv{font-size:13px;font-family:Georgia, serif !important;;background-color:#f6f6f6;border-color:#3166ff;text-align:center}
  .tg .tg-gcws{font-weight:bold;font-size:16px;font-family:"Trebuchet MS", Helvetica, sans-serif !important;;background-color:#34cdf9;color:#dcf6f5;border-color:#3166ff;text-align:center}
  .tg .tg-5m4p{font-size:14px;font-family:"Courier New", Courier, monospace !important;;background-color:#b8e9f8;border-color:#3166ff;text-align:center}
  p { line-height:0.2em }
    </style>




    <?php

    // $local= $_GET['local'];
    // $result = $local;

    $area1 = isset($_GET['area1']) ? $_GET['area1'] : false;
    if($area1){
      // echo htmlentities($_GET['area1'],ENT_QUOTES,"UTF-8");
    }else {
      echo "지역1날씨안되노";
      exit;
    }

    $area2 = isset($_GET['area2']) ? $_GET['area2'] : false;
    if($area1){
      // echo htmlentities($_GET['area2'],ENT_QUOTES,"UTF-8");
    }else {
      echo "지역2날씨안되노";
      exit;
    }

    $area3 = isset($_GET['area3']) ? $_GET['area3'] : false;
    if($area1){
      // echo htmlentities($_GET['area3'],ENT_QUOTES,"UTF-8");
    }else {
      echo "지역3날씨안되노";
      exit;
    }



     require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');
     ?>

     <?
       $query = "SELECT * FROM weather_tbl  WHERE area1 = '$area1' AND area2 = '$area2'
       AND area3 = '$area3' ";

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
				title: '강수량 (mm)',

				},
			1: {
				title: '기온 (°C)',

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
  <style type="text/css" media="screen">

  </style>
  <body>




    <div id="chart_div" style="width: 900px; height: 500px;border:1px solid #a8c83f;float:left;"></div>

    <div class="list" style="float:left; margin-left: 20px;">


      <table class="tg"  style="height: 500px; width: 268px;">

          <tr>
            <th class="tg-gcws" colspan="3">

              <? echo "$area1"; ?>
              <? echo "$area2"; ?>
              <? echo "$area3"; ?>
            </th>
          </tr>
          <tr>
            <td class="tg-5m4p">월</td>
            <td class="tg-5m4p">강수량</td>
            <td class="tg-5m4p">기온</td>
          </tr>

          <?php

      ///////////////////////////////////////////////////////
       require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');


        $query2 = "SELECT * FROM weather_tbl  WHERE area1 = '$area1' AND area2 = '$area2'
        AND area3 = '$area3' ";
        $result2 = mysql_query($query2);

      //하나 하나를 while로 간다 (반복문)
       while($data = mysql_fetch_array($result2))  {
        ?>
        <tr>
          <td class="tg-rnpv"><?=$data[month]?>월</td>
          <td class="tg-rnpv"><?=$data[precipitation]?>mm</td>
          <td class="tg-rnpv"><?=$data[temparatures]?>°C</td>
        </tr>
       <?}

      ?>
    </table>
          <p>참고자료:농촌진흥청 국립농업 과학원</p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;농업 기상 관측</p>

          <!-- <p style="margin-right:100px;">자료:국립농업 과학원 농업기상 관측자료</p> -->
  </div>
  <br>

  </body>
</html>
