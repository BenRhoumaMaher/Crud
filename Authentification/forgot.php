<?php
session_start();
require("../app/app.php");
if(is_post()){
    $email = chars($_POST['email']);
    $errorEmail = validate_required_input($email, "EMAIL", "email");
    if(empty($errorEmail)){
        $message = emailforgot($email);
    }
    if($errorEmail == "" && $message == "") {
        $sql = "SELECT * FROM registration WHERE email =?";
        $smt = $dbc->prepare($sql);
        $smt->execute([$email]);
        $query = $smt->fetch();
        if($query) {
        $subject = "Recovering Password for : ".$email;
            $body = "Welcome " .$query['name']. "<br>" ." Here's your link for recovering : http://localhost/forms/Authentification/recovering.php?token=" .$query['token'];
            $email_to = $email;
            $email_from = "maherbenrhoumaa@gmail.com";
            $sender_name = "M&CODE";
            require('../PHPMailer/PHPMailerAutoload.php');
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "maherbenrhoumaa@gmail.com";
            $mail->Password = "njfzlecqqnisnohh";
            $mail->Port = 25;
            $mail->IsHTML(true);
            $mail->From = $email_from;
            $mail->FromName = $sender_name;
            $mail->Sender = $email_from; // indicates ReturnPath header
            $mail->AddReplyTo($email_from, "No Reply"); // indicates ReplyTo headers
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email_to);
            if($mail->Send()){
                $_SESSION["message"] = ' check your email for the recovering link';
                redirect("login.php");
            }
        }
    }
}




view("Authentification/forgot");