<?php
  header("Content-Type: application/json; charset=UTF-8");

  $connection=mysqli_connect("localhost","anonymous","nr2vEk7BZ^3m","anonymous_godohosting_com");

  $command = $_POST['command'];
  $area1 = $_POST['area1'];
  $area2 = $_POST['area2'];
  $area3 = $_POST['area3'];


  $query = NULL;

  switch($command) {
  case "area1":
    $query = sprintf("SELECT DISTINCT `area1` res FROM `weather_tbl`");
    break;
  case "area2":
    $query = "SELECT DISTINCT `area2` res FROM `weather_tbl` WHERE `area1`='".$area1."'";
    break;
  case "area3":
    $query = "SELECT DISTINCT `area3` res, `area_code` FROM `weather_tbl` WHERE `area1`='".$area1."' AND `area2`='".$area2."'";
    break;

  }

  $result = mysqli_query($connection, $query) or die ("Error in Selecting " . mysqli_error($connection));
  $rows = array("ok"=>true);
  while ($row = $result->fetch_assoc()) {
    $rows['data'][] = $row;
  }
  echo json_encode($rows);
?>
