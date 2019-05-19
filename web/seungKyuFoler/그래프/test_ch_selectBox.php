<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');//db연결

    $query = "SELECT * FROM weather_tbl GROUP BY area1";
    $result = mysql_query($query);
     ?>

    <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript">
	function add() {
		$.ajax({
			url: "chartest1.php",
			type: "GET",
			data: $("form").serialize(),
		}).done(function(data) {
			alert(data);
		});
	}

  // function list(area1,area2,area3){
  //     location.href = 'test_ch_selectBox.php?area1='+document.local.area1.value+'&area2='+document.local.area2.value+'&area3='+document.local.area3.value;
  // }

</script>

    <!-- ///////////////////////////////////////////////// -->

    <form action="chartest1.php" name="local" method="get" >

    <select  name="area1" onchange="list(area1);"  >
     <option value='' >지역1

    <?

      while($data =mysql_fetch_array($result)){
    ?>
    <option value='<?=$data[area1]?>' <?  if($data[area1]==$area1) echo "selected";?>  >
       <?=$data[area1]?>
   <?
     }
    ?>
    </select>
    <!-- /////////////////////////////지역 2 -->

    <select  name="area2" onchange="list(area1,area2);"  >
    <option value='' >지역2

    <?
     $query = "SELECT * FROM weather_tbl GROUP BY area2";
     $result = mysql_query($query);

      while($data =mysql_fetch_array($result)){
    ?>
    <option value='<?=$data[area2]?>' <?  if($data[area2]==$area2) echo "selected";?>  >
       <?=$data[area2]?>
   <?
     }
    ?>
    </select>

    <!-- //////////////////////////////////////////////// -->
    <select  name="area3" onchange="list(area1,area2,area3);"  >
    <option value='' >지역3

    <?
     $query = "SELECT * FROM weather_tbl GROUP BY area3";
     $result = mysql_query($query);

      while($data =mysql_fetch_array($result)){
    ?>
    <option value='<?=$data[area3]?>' <?  if($data[area3]==$area3) echo "selected";?>  >
       <?=$data[area3]?>
   <?
     }
    ?>
    </select>

    <input type="submit" onclick="add()" value="검색2">
    </form>

  </body>
</html>
