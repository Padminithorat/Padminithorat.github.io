<?php

   $firstName = $_POST['first-name'];  
   $lastName = $_POST['last-name'];  
   $email = $_POST['email'];  
   $mobile = $_POST['mobile'];  
   $message = $_POST['message'];  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                   
    $mail->SMTPAuth   = true;       
    $mail->Username   = 'jmdgroups2708@gmail.com';                     //SMTP username
    $mail->Password   = 'lhdkewrotfpibcgk';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
    $mail->Port       = 465;                                  
    //Recipients
    $mail->setFrom($email, $firstName);
    $mail->addAddress('jmdgroups2708@gmail.com');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Contacting from website';
    $mail->Body = '<p>Name :'.$firstName.' '.$lastName.'<br>Email: '.$email.'<br>Phone number: '.$mobile.'<br><br>Message: <br>'.$message.'<br><br>Regards, <br>'.$firstName.'</p>';

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo "<script type='text/javascript'>alert('Message sent successfully');</script>";
    echo '<script>alert("Message sent successfully");</script>';
    echo '<script>window.location.href = "index.html";</script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    //Database connection
    $conn = new mysqli('localhost','root','','JMD');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into jmdcontact(firstName, lastName, email, mobile, message)
            values(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $firstName, $lastName, $email, $mobile, $message);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
?>
