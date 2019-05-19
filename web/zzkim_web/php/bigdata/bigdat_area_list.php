<?php
  header("Content-Type: application/json; charset=UTF-8");

  $connection=mysqli_connect("localhost","anonymous","nr2vEk7BZ^3m","anonymous_godohosting_com");

  $command = $_POST['command'];
  $area_do = $_POST['area_do'];
  $area_si_gun = $_POST['area_si_gun'];

  $query = NULL;

  switch($command) {
  case "area_do":
    $query = sprintf("SELECT DISTINCT `area_do` res FROM `shipment_local`");
    break;
  case "area_si_gun":
    $query = "SELECT DISTINCT `area_si_gun` res FROM `shipment_local` WHERE `area_do`='".$area_do."'";
    break;

  }

  $result = mysqli_query($connection, $query) or die ("Error in Selecting " . mysqli_error($connection));
  $rows = array("ok"=>true);
  while ($row = $result->fetch_assoc()) {
    $rows['data'][] = $row;
  }
  echo json_encode($rows);
?>
