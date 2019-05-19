<?php
  session_start();
?>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>

<?php
// 게시글 삭제 코드

$bnumber = $_GET['bnumber'];       // 글 번호

require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php'); // db에 접근


// 삭제할 글을 복사해서 삭제글관리 게시판에 추가
$query_copy = sprintf("SELECT * FROM board WHERE bnumber='%s'",
                    mysql_real_escape_string($bnumber));

$result_copy = mysql_query($query_copy);
$data = mysql_fetch_array($result_copy);

$query_copy_insert = "INSERT INTO board_delete VALUES($data[bnumber], '$data[title]', '$data[writer]', '$data[bdate]', $data[views], '$data[content]', '$data[filename]')";
$result_copy_insert = mysql_query($query_copy_insert);


// 기존 게시판에 내용을 삭제
$query = sprintf("DELETE FROM board WHERE bnumber='%s'",
                    mysql_real_escape_string($bnumber));

$result = mysql_query($query);


if(!$result) { // 쿼리문 실행여부를 판단
  echo "<script>alert('쿼리문 실행 오류')</script>";
  echo "<script>hitory.back();</script>";
}
else {
  echo "<script>alert('글 삭제 완료')</script>";
  echo "<script>location.href='./board.php'</script>";
}

?>

</body>
</html>
