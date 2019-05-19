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
$username = $_POST['username'];     // 아이디
$password = md5($_POST['password']);  // 비밀번호


require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php'); // db에 접근

$query = "SELECT username, password FROM idin_user_tbl where USERNAME='$username' and PASSWORD='$password'"; // Query문 작성

$result = mysql_query($query); // 작성한 쿼리문에 대한 결과값을 담는 변수 생성

if(!$result) { // 쿼리문 실행여부를 판단
  echo "<script>alert('쿼리문 실행 오류')</script>";
}

if(mysql_num_rows($result)) { //반환 행의 갯수가 0개가 아니면
  $_SESSION['username'] = $username;
  echo "<script>alert('로그인 성공.')</script>";
  echo "<script>location.href='../home.php'</script>";
} else { // 반환 행의 갯수가 0개이면 (DB에 데이터가 없으면 회원이 아닌경우)
  echo "<script>alert('로그인 실패.')</script>";
  echo "<script>location.href='./login.php'</script>";
}

?>

</body>
</html>
