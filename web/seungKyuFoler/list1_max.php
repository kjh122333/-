
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>

    최대가격순
    </title>

    <h2>최대가격순</h2>

  </head>
  <body>

  <table width=80% border="1">  <!-- 연결결하고 사용하고-->
    <tr>
      <td>순번</td>
      <td>디비코드</td>
      <td>날짜</td>
      <td>시장</td>
      <td>품종</td>
      <td>등급</td>
      <td>포장규격</td>
      <td>최대가</td>
    </tr>

    <?php

    $page_num =15;

    $start = $_GET['start'];

    $marketname = $_GET['marketname'];
    $detail_name = $_GET['detail_name'];
    $grade= $_GET['grade'];
    $m_standard = $_GET['m_standard'];


    if(!$start)$start = 0;

////////////////////////////////////////////////////페이징
 require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');
 // 현재 테이블이 전체 개수 구하기
  $query="SELECT count(*) as t FROM all_market_tbl  WHERE  marketname= '$marketname' AND detail_name='$detail_name' AND grade='$grade' AND m_standard='$m_standard' ORDER BY  maxprice DESC  ";
  $result = mysql_query($query);
  $tmp= mysql_fetch_array($result);
  $total =$tmp[t];
  echo $total;

 // 최대 가격순  커리
  $query2 = "SELECT @rownum:=@rownum+1,m_num,avg_price,m_dates,grade,marketname,maxprice,minprice,m_standard,detail_name FROM all_market_tbl,(SELECT@rownum:=0)TMP  WHERE  marketname= '$marketname' AND detail_name='$detail_name' AND grade='$grade'AND m_standard='$m_standard' ORDER BY  maxprice DESC LIMIT $start,$page_num ";
  $result2 = mysql_query($query2);
//////////////////////////////////////////////////////////////

  // <!-- 테이블 설명 / m_num = DB의 순번 / m_dates = 날짜 / markername = 시장 / detail_name = 품종
  // grade = 등급/ m_standard = 포장규격 / maxprice = 최대가  / minprice = 최소가 / avg_price = 평균가 --
############################3
//하나 하나를 while로 간다 (반복문)
 while($data = mysql_fetch_array($result2))  {
  ?>
  <tr>
    <td><?=$data[0]?></td>
    <td><?=$data[m_num]?></td>
    <td><?=$data[m_dates]?></td>
    <td><?=$data[marketname]?></td>
    <td><?=$data[detail_name]?></td>
    <td><?=$data[grade]?></td>
    <td><?=$data[m_standard]?></td>
    <td><?=$data[maxprice]?></td>
  </tr>
 <?}


?>


  </table>
  <a href="http://anonymous.godohosting.com/seungKyuFoler/listBoxForm.php">선택화면으</a>
  <?
  $pages = $total/$page_num;

  for($i=0; $i<=$pages; $i++){
    $assa = $page_num * $i;
    echo "<a href=\"$PHP_SELF?start=$assa&marketname=$marketname&detail_name=$detail_name&grade=$grade&m_standard=$m_standard\">[$i]</a>";
  }

?>
  </body>
</html>
