<?php
  header("Content-Type: application/json; charset=UTF-8");

  $connection=mysqli_connect("localhost","anonymous","nr2vEk7BZ^3m","anonymous_godohosting_com");

  $command     = $_POST['command'];
  $marketname  = $_POST['marketname'];
  $detail_name = $_POST['detail_name'];
  $grade       = $_POST['grade'];
  $m_standard  = $_POST['m_standard'];

  $query = NULL;

  switch($command) {
  case "marketname":
    $query = sprintf("SELECT DISTINCT `marketname` res FROM `all_market_tbl`");
    break;
  case "detail_name":
    $query = "SELECT DISTINCT `detail_name` res FROM `all_market_tbl` WHERE `marketname`='".$marketname."'";
    break;
  case "grade":
    $query = "SELECT DISTINCT `grade` res FROM `all_market_tbl` WHERE `marketname`='".$marketname."' AND `detail_name`='".$detail_name."'";
    break;
  case "m_standard":
    $query = "SELECT DISTINCT `m_standard` res FROM `all_market_tbl` WHERE `marketname`='".$marketname."' AND `detail_name`='".$detail_name."' AND `grade`='".$grade."'";
    break;
  }

  $result = mysqli_query($connection, $query) or die ("Error in Selecting " . mysqli_error($connection));
  $rows = array("ok"=>true);
  while ($row = $result->fetch_assoc()) {
    $rows['data'][] = $row;
  }
  echo json_encode($rows);
?>