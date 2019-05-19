<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>시장 과 품종 선택은 필수입니다</h1>


<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');//db연결



 ?>

 <script type="text/javascript">
   function mySubmit(index){
     if(index == 1){
       document.myForm.action="test_list1.php";
     }
     if(index == 2){
       document.myForm.action="test_list2.php";
     }
     if(index == 3){
       document.myForm.action="test_list3.php";
     }
     if(index == 4){
       document.myForm.action="test.php";
     }
     document.myForm.submit();
   }

   function sel(marketname,detail_name,grade){
       location.href = 'listBoxFormTest.php?marketname='+document.myForm.marketname.value+'&detail_name='+document.myForm.detail_name.value+'&grade='+document.myForm.grade.value;
   }
 </script>

    <form  name="myForm" method="post"  >
      <!-- 1번 select 박스 시장 -->
    <select name="marketname" onchange="sel(marketname);"  >
    <option value='' >지역선택
    <?

     $query = "SELECT * FROM all_market_tbl GROUP BY marketname";
     $result = mysql_query($query);

      while($data =mysql_fetch_array($result)){
    ?>
    <option value='<?=$data[marketname]?>' <?  if($data[marketname]==$marketname) echo " selected ";    ?>  > <?=$data[marketname]?>
   <?

     }
    ?>
    </select>

      <!-- 2번 select 박스 품종 -->
      <select name="detail_name"  onchange="sel(marketname,detail_name);"  >
      <option value=''> 품종선택
      <?
        $query = "SELECT * FROM all_market_tbl WHERE marketname= '$marketname' GROUP BY detail_name";
        $result = mysql_query($query);
        while($data = mysql_fetch_array($result)){

          ?>
          <option value='<?=$data[detail_name]?>' <?  if($data[detail_name]==$detail_name) echo "selected"; ?>  > <?=$data[detail_name]?>
         <?
           }
          ?>
          </select>

        <!-- 3번 select 박스 등급 grade-->
        <select name="grade"  onchange="sel(marketname,detail_name,grade)"  >
        <option value=""> 등급선택
        <?
          $query = "SELECT * FROM all_market_tbl WHERE marketname='$marketname'  AND detail_name='$detail_name' GROUP BY grade";
          $result = mysql_query($query);
          while($data = mysql_fetch_array($result)){
            ?>
            <option value="<?=$data[grade]?>"<?if($data[grade]==$grade)echo "selected";?> >
                <?=$data[grade]?>
        <?
          }
        ?>
        </select>

<input type="submit"  value="최대가격순" onclick="mySubmit(1)" >
<input type="submit"  value="버튼2" onclick="mySubmit(2)" >
<input type="submit"  value="버튼3" onclick="mySubmit(3)" >
<input type="submit"  value="날짜순" onclick="mySubmit(4)" >

    </form>
    <br>


    <!-- 포장규격 자리 -->
    <select  name="marketname" id="marketname">
      <option value="강릉도매시장">강릉도매시장</option>
      <option value="광주각화도매">광주각화도매시장</option>
      <option value="광주서부도매">광주서부도매시장</option>
    </select>
<!-- //////////////////////////////////////////////////////////////////////////// -->




    <!-- 상세검색 -->

  </body>
</html>
