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
// 관리자 계정으로 로그인 했을 때 삭제글을 영구삭제 하는 코드

$bnumber = $_GET['bnumber'];       // 글 번호

require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php'); // db에 접근



///////////////////////////////////////////
// 삭제한 글 다시 복원하기 기능 만들어 볼 것!!
///////////////////////////////////////////


// 삭제 게시판에 있는 글을 영구 삭제
$query = sprintf("DELETE FROM board_delete WHERE bnumber='%s'",
                    mysql_real_escape_string($bnumber));

$result = mysql_query($query);


if(!$result) { // 쿼리문 실행여부를 판단
  echo "<script>alert('쿼리문 실행 오류')</script>";
  echo "<script>hitory.back();</script>";
}
else {
  echo "<script>alert('영구 삭제 완료')</script>";
  echo "<script>location.href='./board.php'</script>";
}

?>

</body>
</html>
