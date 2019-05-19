
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>


    </title>
<script type="text/javascript">

</script>

  </head>
  <body>

  <table width=70% border="1">  <!-- 연결결하고 사용하고-->
    <tr>
      <td>순번</td>
      <td>디비코드</td>
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

     // header("Content-Type:text/html;charset=utf-8");

    $option1 = isset($_POST['marketname'],$_POST['marketname']) ? $_POST['marketname'] : false;
    if($option1){
      echo htmlentities($_POST['marketname'],ENT_QUOTES,"UTF-8");
    }else {
      echo "시장이안되노";
      exit;
    }

    $option2 = isset($_POST['detail_name'],$_POST['detail_name']) ? $_POST['detail_name'] : false;
    if($option2){
      echo htmlentities($_POST['detail_name'],ENT_QUOTES,"UTF-8");
    }else {
      echo "품종이안되노";
      exit;
    }
    $option3 = isset($_POST['grade'],$_POST['grade']) ? $_POST['grade'] : false;
    if($option3){
      echo htmlentities($_POST['grade'],ENT_QUOTES,"UTF-8");
    }else {
      echo "등급이안되노";
      exit;
    }

 require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');

  $query = "SELECT * FROM all_market_tbl";
  $query1 = "SELECT * FROM all_market_tbl WHERE  marketname='강릉도매시장'";


  ## 리미트 걸어둠
  $query2 = "SELECT @rownum:=@rownum+1,m_num,avg_price,m_dates,grade,marketname,maxprice,minprice,m_standard,detail_name FROM all_market_tbl,(SELECT@rownum:=0)TMP  WHERE  marketname= '$option1' AND detail_name='$option2' or grade='$option3' LIMIT 0,30 ";

  //리소스 형식 커리변수
  $result = mysql_query($query2);

  // <!-- 테이블 설명 / m_num = DB의 순번 / m_dates = 날짜 / markername = 시장 / detail_name = 품종
  // grade = 등급/ m_standard = 포장규격 / maxprice = 최대가  / minprice = 최소가 / avg_price = 평균가 -->


############################3
//하나 하나를 while로 간다 (반복문)
 while($data = mysql_fetch_array($result))  {
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
    <td><?=$data[minprice]?></td>
    <td><?=$data[avg_price]?></td>
  </tr>
 <?}

    exit;
    mysql_close($_SERVER);
?>


  </table>




  </body>
</html>
