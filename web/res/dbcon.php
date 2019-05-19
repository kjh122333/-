<?php
    /*
        파일명 : dbcon.php
        제작일 : 2012. 08. 12
        수정일 : 2018. 06. 20
    */

    ## MySQL 정보 ##
    $dbHost = "localhost";
    $dbUser = "anonymous";
    $dbPassword = "nr2vEk7BZ^3m";
    $dbName = "anonymous_godohosting_com";

    ## MySQL 연결 ##
    $conn = @mysql_connect($dbHost, $dbUser, $dbPassword) or die(json_encode(array('responseCode' => 'NG', 'message' => "데이터베이스 연결에 실패하였습니다."))); //DB access denied

    ## MySQL DB선택 ##
    $db = mysql_select_db($dbName);

    if(!$db) {
        $errorNo = mysql_errno();
        $errorMsg = mysql_error();
        echo "ERROR : ".$errorNo."<br />\r\n".$errorMsg;
        exit;
    }
?>
