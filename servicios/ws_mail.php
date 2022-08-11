<?php 
global $mysqli;
global $urlweb;

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontent = "From: $name \n Message: $message";
$recipient = "2200243@usap.edu";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
try{
    mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
}
catch(Exception $e){
    echo "Error!";
    echo $e.getMessage();
}
echo "Thank You!";
?>