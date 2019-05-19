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
$writer = $_SESSION['username'];    // 작성자
$title = $_POST['title'];           // 제목
$content = $_POST['content'];       // 내용
//$upfile =  $_POST['upfile'];    // 첨부파일(어케 합니까?)



// 변수 정리
$upfile = $_FILES["upfile"]["name"];
$type = $_FILES["upfile"]["type"];
$size = $_FILES["upfile"]["size"];
$tmp_name = $_FILES["upfile"]["tmp_name"];
$error = $_FILES["upfile"]["error"];



////
// 파일업로드를 위해 추가한 부분 : 시작 //

// 업로드한 파일이 저장될 디렉토리 정의
$target_dir = "http://anonymous.godohosting.com/zzkim_web/php/board/board_uploads_image";
$target = $targer_dir . "/" . $upfile;

// 조성규씨가 샘플로 실험함.
// $filename = date("logo2").".png";
// move_uploaded_file($_FILES['filename']['tmp_name'], $filename);




//
// if(strcmp($upfile,NULL)) { // 파일첨부를 했을 경우
//
//   // 업로드 금지 파일 식별 부분
//   $filename = explode(".", $upfile_name);
//   $extension = $filename[sizeof($filename)-1];
//
//   if(!strcmp($extension,"html") || !strcmp($extension,"htm") || !strcmp($extension,"php") || !strcmp($extension,"inc")) {
//     $msg = "업로드가 금지된 파일입니다.";
//   }
//
//   // 동일한 파일이 있는지 확인하는 부분
//   $target = $targer_dir . "/" . $upfile_name;
//
//   echo "<script>alert($target)</script>";
//
//   if(file_exists($target)) {
//     $msg = "동일한 파일이 있습니다.";
//   }
//
//   // 지정된 디렉토리에 파일 저장하는 부분
//   if(!copy($upfile, $target)) { // false일 경우
//     $msg = "파일 저장 실패";
//   }
//
//   if(!unlink($upfile)) { // false일 경우
//   // 임시 파일을 삭제하는 부분
//     $msg = "임시 파일 삭제 실패";
//   }
//
// }
//
// else {
//   echo "<script>alert('if문 실행 안됨..')</script>";
//   $target = $targer_dir . "/" . $upfile_name;
// }


///////////
require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php'); // db에 접근

$query = sprintf("INSERT INTO `board`(`title`, `writer`, `content`,`filename`,`path`,`bdate`) VALUES ('%s', '%s','%s','%s','%s', now())",
             mysql_real_escape_string($title),
             mysql_real_escape_string($writer),
             mysql_real_escape_string($content),
             mysql_real_escape_string($upfile_name),
             mysql_real_escape_string($target));


$result = mysql_query($query);

if(!$result) { // 쿼리문 실행여부를 판단
  echo "<script>alert('쿼리문 실행 오류')</script>";
  echo "<script>location.href='./boardwrite.php'</script>";
}
else {
  echo "<script>alert('글 작성 완료')</script>";
  echo "<script>location.href='./board.php'</script>";
}

?>

</body>
</html>
