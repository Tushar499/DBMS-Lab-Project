<?php
include('smtp/PHPMailerAutoload.php');
session_start();
$otp=rand(100000,999999);
$subject="Two Step Verification";
$emailbody="Your 6 Digit OTP Code: ";
$email = $_SESSION['femail'];
$_SESSION["CAP"] = $otp;
echo smtp_mailer($email,$subject,$emailbody.$otp);

function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "kichuna.version2@gmail.com"; 
	$mail->Password = "rgww ofdl sfbj bhnm"; 
	$mail->FromName = "UIU Internal Job Portal"; 
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		header('Location: f_otp_form.php');
	}
}
?>
