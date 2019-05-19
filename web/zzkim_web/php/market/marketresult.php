<!DOCTYPE html>
<html lang="ko">
<meta charset="utf-8">
  <head>
    <title></title>

    <!-- 테이블디자인  -->
    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-e8kc{font-weight:bold;font-size:18px;font-family:Impact, Charcoal, sans-serif !important;;background-color:#a9c840;color:#f1f6df;border-color:#91aa40;text-align:center;vertical-align:top}
.tg .tg-dlgr{font-weight:bold;font-size:18px;font-family:Impact, Charcoal, sans-serif !important;;background-color:#a9c840;color:#f1f6df;border-color:#91aa40;text-align:center}
.tg .tg-enyq{font-size:14px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f4f4f4;border-color:#91aa40;text-align:center;vertical-align:top}
.tg .tg-zsjv{font-size:14px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#f4f4f4;border-color:#91aa40;text-align:center}
</style>
  </head>

  <body>

      <?php

        // marketform의 리스트박스에서 선택하고 보기 버튼을 눌렀을 때 그 값들이 GET방식으로 넘어오고 그 값들을 받는 변수 설정
        $marketname = $_GET['marketname'];
        $detail_name = $_GET['detail_name'];
        $grade = $_GET['grade'];
        $m_standard = $_GET['m_standard'];
        $how = $_GET['how'];

        //DB에 연결
        require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');

        $page_num =30;
        $start = $_GET['start'];

        if(!$start)$start = 0;

      ?>

      <center>
      <table class="tg" style="width: 850px;">
        <tr>
          <th class="tg-dlgr">날짜</th>
          <th class="tg-dlgr">시장</th>
          <th class="tg-dlgr">품목</th>
          <th class="tg-e8kc">등급</th>
          <th class="tg-e8kc">규격</th>
          <th class="tg-e8kc">당일 최저가</th>
          <th class="tg-e8kc">당일 최대가</th>
          <th class="tg-e8kc">평균가</th>
          <!-- <th class="tg-e8kc">예측하기</th> -->
        </tr>

              <?php

               // 최초 출력은 날짜를 오름차순한 기준으로 한다.
               // 리스트박스에 선택을 하고 안하고에 따른 출력방식을 다르게 함.
               if($how=="선택") {

                   if($marketname=="선택") {
                     $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     limit $start, $page_num";

                     $result = mysql_query($query);

                     // $total 구하는 쿼리문
                     $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl";
                     $result2 = mysql_query($query2);
                     $total = mysql_num_rows($result2);

                   } else if($marketname!="선택" && $detail_name=="선택") {
                     $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     WHERE marketname='$marketname'
                     limit $start, $page_num";

                     $result = mysql_query($query);

                     // $total 구하는 쿼리문
                     $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     WHERE marketname='$marketname'";
                     $result2 = mysql_query($query2);
                     $total = mysql_num_rows($result2);

                   } else if($marketname!="선택" && $detail_name!="선택" && $grade=="선택") {
                     $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     WHERE marketname='$marketname' AND detail_name='$detail_name'
                     limit $start, $page_num";

                     $result = mysql_query($query);

                     // $total 구하는 쿼리문
                     $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     WHERE marketname='$marketname' AND detail_name='$detail_name'";
                     $result2 = mysql_query($query2);
                     $total = mysql_num_rows($result2);

                   } else if($marketname!="선택" && $detail_name!="선택" && $grade!="선택" && $m_standard=="선택") {
                     $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade'
                     limit $start, $page_num";

                     $result = mysql_query($query);

                     // $total 구하는 쿼리문
                     $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade'";
                     $result2 = mysql_query($query2);
                     $total = mysql_num_rows($result2);

                   } else if($marketname!="선택" && $detail_name!="선택" && $grade!="선택" && $m_standard!="선택") {
                     $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0),FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard'
                     limit $start, $page_num";

                     $result = mysql_query($query);

                     // $total 구하는 쿼리문
                     $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0),FORMAT(maxprice,0) , FORMAT(avg_price,0)
                     FROM all_market_tbl
                     WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard'";
                     $result2 = mysql_query($query2);
                     $total = mysql_num_rows($result2);

                   }

                } else if($how=="최대가격순") {

                    if($marketname=="선택") {
                      $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      ORDER BY maxprice DESC
                      limit $start, $page_num";

                      $result = mysql_query($query);

                      // $total 구하는 쿼리문
                      $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      ORDER BY maxprice DESC";
                      $result2 = mysql_query($query2);
                      $total = mysql_num_rows($result2);

                    } else if($marketname!="선택" && $detail_name=="선택") {
                      $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      WHERE marketname='$marketname'
                      ORDER BY maxprice DESC
                      limit $start, $page_num";

                      $result = mysql_query($query);

                      // $total 구하는 쿼리문
                      $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      WHERE marketname='$marketname'
                      ORDER BY maxprice DESC";
                      $result2 = mysql_query($query2);
                      $total = mysql_num_rows($result2);

                    } else if($marketname!="선택" && $detail_name!="선택" && $grade=="선택") {
                      $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      WHERE marketname='$marketname' AND detail_name='$detail_name'
                      ORDER BY maxprice DESC
                      limit $start, $page_num";

                      $result = mysql_query($query);

                      // $total 구하는 쿼리문
                      $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      WHERE marketname='$marketname' AND detail_name='$detail_name'
                      ORDER BY maxprice DESC";
                      $result2 = mysql_query($query2);
                      $total = mysql_num_rows($result2);

                    } else if($marketname!="선택" && $detail_name!="선택" && $grade!="선택" && $m_standard=="선택") {
                      $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade'
                      ORDER BY maxprice DESC
                      limit $start, $page_num";

                      $result = mysql_query($query);

                      // $total 구하는 쿼리문
                      $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade'
                      ORDER BY maxprice DESC";
                      $result2 = mysql_query($query2);
                      $total = mysql_num_rows($result2);

                    } else if($marketname!="선택" && $detail_name!="선택" && $grade!="선택" && $m_standard!="선택") {
                      $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard'
                      ORDER BY maxprice DESC
                      limit $start, $page_num";

                      $result = mysql_query($query);

                      // $total 구하는 쿼리문
                      $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                      FROM all_market_tbl
                      WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard'
                      ORDER BY maxprice DESC";
                      $result2 = mysql_query($query2);
                      $total = mysql_num_rows($result2);

                    }

                 } else if($how=="최저가격순") {

                     if($marketname=="선택") {
                       $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       ORDER BY minprice ASC
                       limit $start, $page_num";

                       $result = mysql_query($query);

                       // $total 구하는 쿼리문
                       $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       ORDER BY minprice ASC";
                       $result2 = mysql_query($query2);
                       $total = mysql_num_rows($result2);

                     } else if($marketname!="선택" && $detail_name=="선택") {
                       $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       WHERE marketname='$marketname'
                       ORDER BY minprice ASC
                       limit $start, $page_num";

                       $result = mysql_query($query);

                       // $total 구하는 쿼리문
                       $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       WHERE marketname='$marketname'
                       ORDER BY minprice ASC";
                       $result2 = mysql_query($query2);
                       $total = mysql_num_rows($result2);

                     } else if($marketname!="선택" && $detail_name!="선택" && $grade=="선택") {
                       $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       WHERE marketname='$marketname' AND detail_name='$detail_name'
                       ORDER BY minprice ASC
                       limit $start, $page_num";

                       $result = mysql_query($query);

                       // $total 구하는 쿼리문
                       $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       WHERE marketname='$marketname' AND detail_name='$detail_name'
                       ORDER BY minprice ASC";
                       $result2 = mysql_query($query2);
                       $total = mysql_num_rows($result2);

                     } else if($marketname!="선택" && $detail_name!="선택" && $grade!="선택" && $m_standard=="선택") {
                       $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade'
                       ORDER BY minprice ASC
                       limit $start, $page_num";

                       $result = mysql_query($query);

                       // $total 구하는 쿼리문
                       $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade'
                       ORDER BY minprice ASC";
                       $result2 = mysql_query($query2);
                       $total = mysql_num_rows($result2);

                     } else if($marketname!="선택" && $detail_name!="선택" && $grade!="선택" && $m_standard!="선택") {
                       $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard'
                       ORDER BY minprice ASC
                       limit $start, $page_num";

                       $result = mysql_query($query);

                       // $total 구하는 쿼리문
                       $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                       FROM all_market_tbl
                       WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard'
                       ORDER BY minprice ASC";
                       $result2 = mysql_query($query2);
                       $total = mysql_num_rows($result2);

                     }



                   } else if($how=="성출하기간") {
                              $query2 = "SELECT shipment_time_start, shipment_time_end
                              FROM agricultural_varieties_tbl
                              WHERE detail_name='$detail_name'";
                              $result2 = mysql_query($query2);
                              $tmp = mysql_fetch_array($result2);
                              $shipment_time_start = $tmp[shipment_time_start];
                              $shipment_time_end = $tmp[shipment_time_end];
                              if($marketname!="선택" && $detail_name!="선택" && $grade=="선택") {
                              $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                                FROM all_market_tbl
                                WHERE m_dates BETWEEN '$shipment_time_start' AND '$shipment_time_end'
                                AND marketname LIKE '%$marketname%' AND detail_name LIKE '%$detail_name%'
                                limit $start, $page_num";
                                $result = mysql_query($query);

                                // $total 구하는 쿼리문
                                $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                                FROM all_market_tbl
                                WHERE m_dates BETWEEN '$shipment_time_start' AND '$shipment_time_end'
                               AND marketname LIKE '%$marketname%' AND detail_name LIKE '%$detail_name%'";

                                $result2 = mysql_query($query2);
                                $total = mysql_num_rows($result2);

                              } else if($marketname!="선택" && $detail_name!="선택" && $grade!="선택" && $m_standard=="선택") {
                                $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                                FROM all_market_tbl
                                WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade'
                                AND m_dates BETWEEN '$shipment_time_start' AND '$shipment_time_end'
                                limit $start, $page_num";
                                $result = mysql_query($query);
                                // $total 구하는 쿼리문
                                $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                                FROM all_market_tbl
                                WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade'
                                AND m_dates BETWEEN '$shipment_time_start' AND '$shipment_time_end'";
                                $result2 = mysql_query($query2);
                                $total = mysql_num_rows($result2);

                              } else if($marketname!="선택" && $detail_name!="선택" && $grade!="선택" && $m_standard!="선택") {
                                $query = "SELECT m_dates, marketname, detail_name, grade, m_standard,  FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                                FROM all_market_tbl
                                WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard'
                                AND m_dates BETWEEN '$shipment_time_start' AND '$shipment_time_end'
                                limit $start, $page_num";
                                $result = mysql_query($query);

                                // $total 구하는 쿼리문
                                $query2 = "SELECT m_dates, marketname, detail_name, grade, m_standard, FORMAT(minprice,0) , FORMAT(maxprice,0) , FORMAT(avg_price,0)
                                FROM all_market_tbl
                                WHERE marketname='$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard'
                                AND m_dates BETWEEN '$shipment_time_start' AND '$shipment_time_end'";
                                $result2 = mysql_query($query2);
                                $total = mysql_num_rows($result2);
                              }

                  }

                 //하나 하나를 while로 출력한다.
                 while($data = mysql_fetch_array($result))  {
                   ?>
                   <tr>
                     <td class="tg-zsjv" align="center"><?=$data[m_dates]?></td>
                     <td class="tg-zsjv" align="center"><?=$data[marketname]?></td>
                     <td class="tg-zsjv" align="center"><?=$data[detail_name]?></td>
                     <td class="tg-enyq" align="center"><?=$data[grade]?></td>
                     <td class="tg-enyq" align="center"><?=$data[m_standard]?></td>
                     <td class="tg-enyq" align="center"><?=$data["FORMAT(minprice,0)"]?></td>
                     <td class="tg-enyq" align="center"><?=$data["FORMAT(maxprice,0)"]?></td>
                     <td class="tg-enyq" align="center"><?=$data["FORMAT(avg_price,0)"]?></td>
                     <!-- <td class="tg-enyq" align="center"><a href='../bigdata/expect.php?m_dates=<?=$data[m_dates]?>&marketname=<?=$data[marketname]?>&detail_name=<?=$data[detail_name]?>&grade=<?=$data[grade]?>&m_standard=<?=$data[m_standard]?>&minprice=<?=$data[minprice]?>&maxprice=<?=$data[maxprice]?>&avg_price=<?=$data[avg_price]?>&how=<?=$how?>'>예측</a></td> -->
                   </tr>


                  <?
                    }
                  ?>

              </table>
              <br>

            <!-- ########################################################################### -->


            <?php

              $assa = $_GET['start'];
              $prev = $assa - $page_num;
              $after = (($assa/$page_num)+1) * $page_num;

              if($prev < 0) {
                $prev = 0;
              }

              if($after > $total) {
                $after = $after - $page_num;
              }

              $marketname = $_GET['marketname'];
              $detail_name = $_GET['detail_name'];
              $grade = $_GET['grade'];
              $m_standard = $_GET['m_standard'];
              $how = $_GET['how'];


              echo "<a href='./marketresult.php?start=0&marketname=$marketname&detail_name=$detail_name&grade=$grade&m_standard=$m_standard&how=$how'>◀◀</a>"; ?> &nbsp; <?php

              echo "<a href=./marketresult.php?start=$prev&marketname=$marketname&detail_name=$detail_name&grade=$grade&m_standard=$m_standard&how=$how>[이전]</a>"; ?> &nbsp; <?php

              $case = $total % $page_num;
              $pages = (int)($total / $page_num);
              $last = $pages * $page_num;

              if($case!=0) {

              for($i=1; $i<=$pages+1; $i++) {
                $assa = $page_num * ($i-1);
                echo "<a href=./marketresult.php?start=$assa&marketname=$marketname&detail_name=$detail_name&grade=$grade&m_standard=$m_standard&how=$how>[$i]</a>"; ?> &nbsp;
              <?php
                }
              } else {

                for($i=1; $i<=$pages; $i++) {
                  $assa = $page_num * ($i-1);
                  echo "<a href=./marketresult.php?start=$assa&marketname=$marketname&detail_name=$detail_name&grade=$grade&m_standard=$m_standard&how=$how>[$i]</a>"; ?> &nbsp;
                <?php
                }
              }



              echo "<a href=./marketresult.php?start=$after&marketname=$marketname&detail_name=$detail_name&grade=$grade&m_standard=$m_standard&how=$how>[다음]</a>"; ?> &nbsp; <?php
              echo "<a href='./marketresult.php?start=$last&marketname=$marketname&detail_name=$detail_name&grade=$grade&m_standard=$m_standard&how=$how'>▶▶</a>";

              ?>

              </center>

  </body>
</html>
