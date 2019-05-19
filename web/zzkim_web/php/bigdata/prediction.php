<!DOCTYPE html>
<html lang="en" dir="ltr">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <head>
    <!-- 데이블 디자인 -->

    <?php

    // $local= $_GET['local'];
    // $result = $local;

    $area_do = isset($_GET['area_do']) ? $_GET['area_do'] : false;
    if($area_do){
      echo htmlentities($_GET['area_do'],ENT_QUOTES,"UTF-8");
    }else {
      echo "지역1안되노";
      exit;
    }

    $area_si_gun = isset($_GET['area_si_gun']) ? $_GET['area_si_gun'] : false;
    if($area_do){
      echo htmlentities($_GET['area_si_gun'],ENT_QUOTES,"UTF-8");
    }else {
      echo "지역2안되노";
      exit;
    }


     require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');
     ?>
      <!-- 도 / 시군을 select box 로 선택하면 해당 지역의 작물이 나오는 코드 ex) 강원도 춘천시 -> 가지 -->
     <?
       $query = "SELECT * FROM shipment_local  WHERE area_do = '$area_do' AND area_si_gun = '$area_si_gun'";

      ?>

      <?php

      $result = mysql_query($query); // 작성한 쿼리문에 대한 결과값을 담는 변수 생성

             // $row=mysql_fetch_assoc($rsult);
             // $src =$row['shipment_image'];
             // echo"<img src='$src'/>"
    ?>
    <p>선택한 지역에서 출하량이 많은 품목의 그래프 및 표</p>
    <?
      while($data = mysql_fetch_array($result))  { // 결과값을 반복문을 통해 조회 및 대조
    ?>

        <tr>
          <td  align="center"><?=$data[ranking]?></td>
          <td  align="center"><?=$data[detail_name]?></a></td>
          <br>
          <td  align="center"><img src=<?=$data[shipment_image]?>></td><br>


          <!-- <img src="/images/attach/logo_black.png" width="245"> -->
        </tr>

      <?}

        exit;
      ?>



  </body>
</html>
