<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>경락가격보기 선택 </h1>
    <script type="text/javascript">
      function mySubmit(index){
        if(index == 1){
          document.myForm.action="list1_max.php";
        }
        if(index == 2){
          document.myForm.action="list2_min.php";
        }
        if(index == 3){
          document.myForm.action="list3_term.php";
        }
        if(index == 4){
          document.myForm.action="list4_date.php";
        }
        document.myForm.submit();
      }


    </script>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');//db연결

 $query = "SELECT DISTINCT marketname FROM all_market_tbl";
 $result = mysql_query($query);


 ?>


    <form  name="myForm" method="get">
      <!-- 1번 select 박스 시장 -->
    <select  name="marketname" >
      <option value="강릉도매시장">강릉도매시장</option>
      <option value="광주각화도매">광주각화도매시장</option>
      <option value="광주서부도매">광주서부도매시장</option>
    </select>

      <!-- 2번 select 박스 품종 -->
    <select  name="detaile_name" >
      <option value="가지(일반)">가지(일반)</option>
      <option value="고추(청양)">고추(청양) </option>
      <option value="단호박">단호박</option>
      <option value="딸기(설향)">딸기(설향)</option>
    </select>
        <!-- 3번 select 박스 등급 -->
    <select  name="grade" >
      <option value="특">특</option>
      <option value="상">상</option>
      <option value="보통">보통</option>
      <option value="없음">없음</option>
    </select>


    <!-- 포장규격 자리 -->
    <select  name="m_standard" >
        <option value="1.5kg">1.5kg</option>
        <option value="2kg">2kg</option>
      <option value=".5kg">.5kg</option>
      <option value="8kg 상자">8kg 상자</option>
      <option value="10kg 상자">10kg 상자</option>
    </select>

<input type="submit"  value="최대가격순" onclick="mySubmit(1)" >
<input type="submit"  value="최저가격순" onclick="mySubmit(2)" >
<input type="submit"  value="출하기간순" onclick="mySubmit(3)" >
<input type="submit"  value="날짜순" onclick="mySubmit(4)" >

    </form>
    <br>






    <!-- 상세검색 -->

  </body>
</html>
