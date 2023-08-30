<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$response =[];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo("creating post request");
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $to = 'makaraisabel@gmail.com'; // Change to your Gmail address
  $subject = 'New Contact Form Submission';
  $headers = "From: $email";
  

  echo("running the mailing..");
  if (mail($to, $subject, $message, $headers)) {
    $response['status'] ='success';
    $response['message'] = 'Email sent successfully';

    // echo json_encode(['message' => 'Email sent successfully']);
  } else {
    $response['status'] ='error';
    $response['message'] = 'failed to send email';
    // echo json_encode(['error' => 'Failed to send email']);
  }
}
else{
  $reponse['status'] = 'error';
  $response['message'] = 'POST method could not be called';
}
header('Content-Type:application/json');
echo json_encode($response);
?>
