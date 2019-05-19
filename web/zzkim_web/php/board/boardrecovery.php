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
// 게시글 복원 코드 ( board_delete테이블에서 복원시킬 row를 복사하여 board테이블에 insert into하고 board_delete의 row는 delete문을 사용해 행을 삭제한다.)

$bnumber = $_POST['bnumber'];       // 글 번호

require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php'); // db에 접근


// 복원할 글을 복사하여 board테이블에 다시 insert (복원 )
$query_recovery = sprintf("SELECT * FROM board_delete WHERE bnumber='%s'",
                    mysql_real_escape_string($bnumber));

$result_recovery = mysql_query($query_recovery);
$data = mysql_fetch_array($result_recovery);

$query_recovery_insert = "INSERT INTO board VALUES($data[bnumber], '$data[title]', '$data[writer]', '$data[bdate]', $data[views], '$data[content]', '$data[filename]')";
$result_recovery_insert = mysql_query($query_recovery_insert);


// 삭제글 관리 게시판에 복원할 글을 삭제
$query = sprintf("DELETE FROM board_delete WHERE bnumber='%s'",
                    mysql_real_escape_string($bnumber));

$result = mysql_query($query);


if(!$result) { // 쿼리문 실행여부를 판단
  echo "<script>alert('쿼리문 실행 오류')</script>";
  echo "<script>hitory.back();</script>";
}
else {
  echo "<script>alert('글 복원 완료')</script>";
  echo "<script>location.href='./board.php'</script>";
  echo "<script>parent.opener.location.reload()</script>";
}

?>

</body>
</html>
