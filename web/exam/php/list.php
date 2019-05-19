<?php
  header('Content-Type: application/json; charset=UTF-8');

  require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php');

  $page = $_GET['page'];
  $limit = 10; //출력 수 제한

  $count = mysql_num_rows(mysql_query('SELECT * FROM `board`')); //전체 글 갯수
  $last_page = (int)(($count - 1) / $limit) + 1;

  if($page < 1 || $page > $last_page) {
    die(json_encode(array('ok'=>false, 'msg'=>'페이지가 존재하지 않습니다.')));
  }

  $query = sprintf("SELECT bnumber, title, writer, bdate, views FROM `board` ORDER BY `board`.`bnumber` DESC LIMIT %s, %s", ($page - 1) * $limit, $limit);
  $result = mysql_query($query);

  if(!$result) {
    die(json_encode(array('ok'=>false, 'msg'=>'데이터를 불러오지 못했습니다.')));
  }

  while($row = mysql_fetch_object($result)) {
    $data[] = $row;
  }

  echo json_encode(array('ok'=>true, 'count'=>$count, 'last_page'=>$last_page, 'data'=>$data));
?>
