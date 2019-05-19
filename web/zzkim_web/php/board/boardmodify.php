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
// 게시글 수정 폼에서 넘겨받은 파라미터 값들을 DB에 업데이트 한다.

$writer = $_SESSION['username'];    // 작성자
$title = $_POST['title'];           // 제목
$content = $_POST['content'];       // 내용
$filename =  $_POST['filename'];    // 첨부파일(어케 합니까?)
$bnumber = $_GET['bnumber'];       // 글 번호


require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php'); // db에 접근

$query = sprintf("UPDATE board SET title='%s', content='%s', filename='%s', bdate=now() WHERE bnumber='%s'",
                    mysql_real_escape_string($title),
                    mysql_real_escape_string($content),
                    mysql_real_escape_string($filename),
                    mysql_real_escape_string($bnumber));

$result = mysql_query($query);


if(!$result) { // 쿼리문 실행여부를 판단
  echo "<script>alert('쿼리문 실행 오류')</script>";
  echo "<script>hitory.back();</script>";
}
else {
  echo "<script>alert('글 수정 완료')</script>";
  echo "<script>location.href='./boarddetail.php?bnumber=$bnumber'</script>";
}

?>

</body>
</html>
