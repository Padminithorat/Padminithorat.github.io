<?php
    $fname = $_POST["fname"];
    $email = $_POST["email"];
    $message = $_POST["message"];


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
        $mail->Subject = 'Contacting from reviews';
        $mail->Body = '<p>Name :'.$fname.'<br>Email: '.$email.'<br><br>Message: <br>'.$message.'<br><br>Regards, <br>'.$fname.'</p>';
    
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        // echo "<script type='text/javascript'>alert('Message sent successfully');</script>";
        echo '<script>alert("Message sent successfully");</script>';
        echo '<script>window.location.href = "index.html";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "localhost";
$user = "root";
$password = "";
$db = "jmdb";

$conn = new mysqli($server, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "INSERT INTO review (Username, Email, Review) VALUES ('$fname', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Data has been inserted successfully, but no success response is sent.
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error));
    }

    $conn->close();
}
?>
