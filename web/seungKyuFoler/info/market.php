<?php
  //MIME 타입 변경
  header('Content-Type: application/json; charset=UTF-8;');

  require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');

  $query = sprintf('SELECT DISTINCT `marketname` FROM `all_market_tbl`');

  $result = mysql_query($query);

  if(!$result) {
      return false;
  }

  $jsonData['ok'] = true;
  for($i = 0; $row = mysql_fetch_object($result); $i++) {
    $jsonData['data'][$i] = $row;
  }
  
  echo json_encode($jsonData);
?>
