<?php

// $local= $_POST['local'];
// $result = $local;

$option1 = isset($_POST['local'],$_POST['local']) ? $_POST['local'] : false;
if($option1){
  echo htmlentities($_POST['local'],ENT_QUOTES,"UTF-8");
}else {
  echo "지역날씨안되노";
  exit;
}

 require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');

   $query = "SELECT area_code,month,temperatures,precipitation
   FROM weather  WHERE  area_code= '$option1' AND month='1'";

   $result = mysql_query($query);

   while($data = mysql_fetch_array($result)) {


     echo $data[precipitation];
     echo $data[temperatures];

   }

  ?>
