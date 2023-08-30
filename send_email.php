<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $name = $_POST['name'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'makaraisabel@gmail.com'; // Your Gmail address
        // $mail->Password = 'your_gmail_password';
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 1025;

        // SMTP configuration for MailHog
        $mail->isSMTP();
        $mail->Host = '127.0.0.1'; // MailHog's SMTP server address
        $mail->SMTPAuth = false; // MailHog doesn't require authentication
        $mail->Port = 1025; // MailHog's SMTP server port

        // Sender and recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('makaraisabel@gmail.com', 'Isabel'); // Recipient's email address and name

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send the email
        $mail->send();
        echo 'Email sent successfully';
    } 
    catch (Exception $e) {
        echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
    }
} else {
    echo 'Invalid request method';
}
?>
