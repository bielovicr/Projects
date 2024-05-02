<?php
session_start();
include_once 'inc/functions.php';
include_once "inc/config.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : '';
if($id){
    $sql = "SELECT * FROM users where id = '$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $name = $row['first_name'] . ' ' . $row['last_name'];
    



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'f06d706ebabbca';
    $mail->Password = 'e3109ce667b539';

    //Recipients
    $mail->setFrom('upomienka@kniznica.sk', 'Library');
    $mail->addAddress($email, $name);     //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('upomienka@kniznica.sk', 'Library');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Upomienka';
    $mail->Body    = 'K dnesnemu datumu ste nevratili nasledujuce knihy:';
    $mail->AltBody = 'K dnesnemu datumu ste nevratili nasledujuce knihy:';

    $mail->send();
    $_SESSION['email_ok'] = 'Message has been sent';
    
} catch (Exception $e) {
    $_SESSION['email_error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    }
else 
{
    $_SESSION['email_error'] = 'User not found';
}
}
else 
{
    $_SESSION['email_error'] = 'Error';
}
header('Location: loans.php');
