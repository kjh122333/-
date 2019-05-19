<!-- 메일이 정상적으로 가는지 테스트 -->

<?php
 //$mailto="받는주소";
 $mailto="snoopingh@naver.com";
 $subject="mail test";
 $content="test";
 $result=mail($mailto, $subject, $content);
 if($result){
  echo "mail success";
  }else  {
  echo "mail fail";
 }
?>
