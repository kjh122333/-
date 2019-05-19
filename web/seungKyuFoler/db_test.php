
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>


    </title>
  </head>
  <body>


  <table width=600 border="1">  <!-- 연결결하고 사용하고-->
    <tr>
      <td>순번</td>
      <td>날짜</td>
      <td>시장</td>
      <td>품종</td>
      <td>등급</td>
      <td>포장규격</td>
      <td>최대가</td>
      <td>최소가</td>
      <td>평균가</td>

    </tr>

<?php


 require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');

  $query = "SELECT * FROM all_market_tbl";
  $query1 = "SELECT * FROM all_market_tbl WHERE  marketname='강릉도매시장'";

  $query2 = "SELECT * FROM all_market_tbl WHERE  marketname= '강릉도매시장' AND detail_name='가지(일반)'";
  //리소스 형식 커리변수
  $result = mysql_query($query2);

//하나를 while로 간다 (반복문)
 while($data = mysql_fetch_array($result))  {
  ?>
  <!-- 테이블 설명 / m_num = DB의 순번 / m_dates = 날짜 / markername = 시장 / detail_name = 품종
  grade = 포장규격 / maxprice = 최대가  / minprice = 최소가 / avg_price = 평균가 -->

  <tr>
    <td><?=$data[m_num]?></td>
    <td><?=$data[m_dates]?></td>
    <td><?=$data[marketname]?></td>
    <td><?=$data[detail_name]?></td>
    <td><?=$data[grade]?></td>
    <td><?=$data[m_standard]?></td>
    <td><?=$data[maxprice]?></td>
    <td><?=$data[minprice]?></td>
    <td><?=$data[avg_price]?></td>
  </tr>
 <?}
    exit;
?>

  </table>




  </body>
</html>
