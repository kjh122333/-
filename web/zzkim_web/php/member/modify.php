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
// myinfo.php페이지에서 수정하기 위해 post방식으로 넘겨받은 파라매터 값들
// 회원정보값은 수정이 불가능하고, 개인정보는 등록일시를 제외하고 수정이 가능하다.
// 수정 가능한 값들이 넘어오고 이를 DB에 update 쿼리문을 이용하여 변경된 정보로 다시 최신화 한다.

$username = $_POST['username'];                  // 아이디
$real_name = $_POST['real_name'];                // 이름
$phone_number = $_POST['phone_number'];          // 전화번호
$farm_name = $_POST['farm_name'];                // 농장이름
$area_code = $_POST['area_code'];                // 지역코드

require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php'); // db에 접근

$query = "UPDATE idin_user_tbl
          SET real_name='$real_name', phone_number='$phone_number', farm_name='$farm_name', area_code='$area_code'
          WHERE username='$username'"; // Query문 작성

$result = mysql_query($query); // 작성한 쿼리문에 대한 결과값을 담는 변수 생성

if(!$result) { // 쿼리문 실행여부를 판단
  echo "<script>alert('쿼리문 실행 오류')</script>";
}
else {
  echo "<script>alert('내 정보가 정상적으로 수정되었습니다.')</script>";
  echo "<script>location.href='./myInfo.php'</script>";
}

?>

</body>
</html>
