<?php
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

echo $name.$email_address.$phone.$message;

// Create the email and send the message
$to = 'snoopingh@naver.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Dozo에서 문의메일이 도착했습니다. ( 회원 아이디 : $name )";
$email_body = "1 : 1 문의하기\n\n"."회원 아이디: $name\n\n이메일: $email_address\n\n연락처: $phone\n\n내용:\n$message";

$headers = "From: noreply@anonymous.godohosting.com/zzkim_web/php/home.php\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";

mail($to,$email_subject,$email_body,$headers);

?>
